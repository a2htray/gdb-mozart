<?php

namespace A2htray\GDBMozart\Commands;

use Illuminate\Console\Command;

class ImportPersimmonsAboutPackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mozart:import-persimmons {packageName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import persimmons about a new installed package';

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
        $packageName = $this->argument('packageName');
        $fragments = explode('/', $packageName);

        if (count($fragments) != 2) {
            echo 'Type the right package name' . PHP_EOL;
        }

        $persimmonFile = base_path() . '/vendor/' . $packageName . '/persimmons.php';

        if (!file_exists($persimmonFile)) {
            echo 'Could not locate the persimmon file';
        }

        $persimmons = require_once $persimmonFile;

        var_dump($persimmons);

        // TODO code the logical importation of persimmons about a new installed package
    }
}
