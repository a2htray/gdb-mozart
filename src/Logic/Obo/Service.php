<?php

namespace A2htray\GDBMozart\Logic\Obo;


use A2htray\GDBMozart\Models\Cv;
use A2htray\GDBMozart\Models\CvTerm;
use A2htray\GDBMozart\Models\OboFile;
use PhpObo\LineReader,
    PhpObo\Parser;
use PhpObo\OboDocument;
use PhpObo\OboHeader;
use PhpObo\OboStanza;

class Service
{
    private $oboFileInfo = [];   // the file path of obo
    private $uploadUserID;
    private $progress = 1;  // show the loading progress to user
    private $message;
    private $cv;
    private $oboFile;

    public function __construct(OboFile $oboFile, int $uploadUserID)
    {
        // if could not locate the file, exit the program
        if (!file_exists($oboFile->local_uri)) {
            $this->message = 'Could not locate the obo file ' . $oboFile;
        }
        $this->oboFileInfo['path'] = $oboFile->local_uri;
        $this->oboFileInfo['size'] = filesize($oboFile->local_uri);
        $this->uploadUserID = $uploadUserID;
        $this->oboFile = $oboFile;
        $this->cv = new Cv();
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function run()
    {
        $handle = fopen($this->oboFileInfo['path'], 'r');
        $lineReader = new LineReader($handle);
        $parser = new Parser($lineReader);
        $parser->retainTrailingComments(false);
        $parser->getDocument()->mergeStanzas(false); //speed tip
        $parser->parse();

        /**
         * @var OboDocument $document
         */
        $document = $parser->getDocument();
        /**
         * @var OboHeader $header
         */
        $header = $document->getHeader();
        $headerTVPair = $header->getTVPairs();
        $this->cv->namespace = $headerTVPair['default-namespace'] ?? $headerTVPair['namespace'] ?? '';
        unset($headerTVPair['default-namespace']);
        unset($headerTVPair['namespace']);

        $this->cv->ontology = $headerTVPair['ontology'] ?? '';
        unset($headerTVPair['ontology']);

        $this->cv->metadata = json_encode($headerTVPair);

        $defTVPair = array_map(function ($x) {
            return $x->getTVPairs();
        }, $document->getStanzas('Typedef'));
        $this->cv->def_metadata = json_encode($defTVPair);
        $this->cv->upload_user_id = $this->uploadUserID;
        $this->cv->save();

        $terms = $document->getStanzas('Term');

        $total = count($terms);
        $num = 0;
        foreach ($terms as $item) {
            /**
             * @var OboStanza $item
             */
            $tvPairs = $item->getTVPairs();

            $cvTerm = new CvTerm();
            $cvTerm->cv_id = $this->cv->id;
            $cvTerm->term_id = $tvPairs['id'];
            $cvTerm->name = $tvPairs['name'];
            unset($tvPairs['id']);
            unset($tvPairs['name']);

            $relation = [];

            if (isset($tvPairs['is_a'])) {
                $relation['is_a'] = $tvPairs['is_a'];
            }

            if (isset($tvPairs['relationship'])) {
                $relation['relationship'] = $tvPairs['relationship'];
            }

            $cvTerm->metadata = json_encode($tvPairs);
            $cvTerm->relation = json_encode($relation);
            $cvTerm->save();

            echo (++$num) . ' of ' . $total . ' handle Term ' . $cvTerm->name . PHP_EOL;
        }

        $this->oboFile->is_completed = true;
        $this->oboFile->save();
    }

    public function getCv()
    {
        return $this->cv;
    }
}
