<?php

namespace A2htray\GDBMozart\Commands;

use A2htray\GDBMozart\Logic\Obo\Service as OboService;
use A2htray\GDBMozart\Models\OboFile;
use A2htray\GDBMozart\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoadOboCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mozart:load-obo {username} {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command after submitting a obo file';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::where(['name' => $this->argument('username')])->first();
        if (is_null($user)) {
            echo 'Could not find this user named ' . $this->argument('username') . PHP_EOL;
            return null;
        }

        $filepath = $this->argument('filepath');

        $oboFile = OboFile::where(['local_uri' => $filepath, 'submit_user_id' => $user->id, 'is_completed' => false])->first();
        if (is_null($oboFile)) {
            echo 'Could not find the record of this obo file' .PHP_EOL;
            return null;
        }

        if (!file_exists($filepath)) {
            echo 'Could not locate the obo file ' . $filepath . PHP_EOL;
            return null;
        }

        print "\nNOTE: Loading of this OBO file is performed using a database transaction. \n" .
            "If the load fails or is terminated prematurely then the entire set of \n" .
            "insertions/updates is rolled back and will not be found in the database\n\n";
        $service = new OboService($oboFile, $user->id);

        DB::beginTransaction();
        try {
            $service->run();
            DB::commit();
        } catch (\Exception $e) {
            echo $service->getMessage() . PHP_EOL;
            Log::critical('Loading obo file', [$e]);
            DB::rollBack();
        }

        return null;
    }
}
