<?php

namespace A2htray\GDBMozart\Logic\Obo;


class Service
{
    private $oboFile;   // the file path of obo
    private $progress = 1;  // show the loading progress to user
    private $message;
    private $metaData = [];

    public function __construct(string $oboFile)
    {
        // if could not locate the file, exit the program
        if (!file_exists($oboFile)) {
            $this->message = 'Could not locate the obo file ' . $oboFile . PHP_EOL;
            exit(0);
        }
        
        $this->oboFile = $oboFile;
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
        $readMetaDataFlag = true;
        
        $fp = fopen($this->oboFile, 'r');
        while ($line = fgets($fp)) {
            $line = trim($line);
            if ($line == '') continue;
            $line = preg_replace('/[^(\x20-\x7F)]*/', '', $line);

            // Read the metadata
            if ($readMetaDataFlag) {
                var_dump(array_map('trim', explode(':', $line)));
            }
            
            if (preg_match('/^\[/', $line)) break;

            // TODO IMPORTANT TO DO, I CAN DO IT
            
        }
    }
}

$service = new Service('/Users/a2htray/Desktop/BGI_BIG_DATA/GENE_DATABASE/gene_database_src/newVendor/a2htray/gdb-mozart/files/obo/so.obo');

$service->run();

echo $service->getMessage() . PHP_EOL;