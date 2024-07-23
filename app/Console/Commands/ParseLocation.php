<?php

namespace App\Console\Commands;

use App\Services\ParseXML\LocationsImporter;
use Illuminate\Console\Command;

class ParseLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse locations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start parsing Locations...');
        $start = microtime(true);
        $url = 'ftp://' . config('ftp.login') . ':' . config('ftp.password') . '@' . config('ftp.server');
        $locationsImporter = new LocationsImporter();
        $locationsImporter->import($url);
        $end = microtime(true);
        $this->info('Parse time:'.$end-$start);
        return Command::SUCCESS;
    }
}
