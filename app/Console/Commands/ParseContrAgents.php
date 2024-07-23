<?php

namespace App\Console\Commands;

use App\Services\ParseXML\ContragentsImporter;
use Illuminate\Console\Command;

class ParseContrAgents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:contragents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start parsing Contragents...');
        $start = microtime(true);
        $url = 'ftp://' . config('ftp.login') . ':' . config('ftp.password') . '@' . config('ftp.server');
        $contragentImporter = new ContragentsImporter();
        $contragentImporter->import($url);
        $end = microtime(true);
        $this->info('Parse time:'.$end-$start);
        return Command::SUCCESS;
    }
}
