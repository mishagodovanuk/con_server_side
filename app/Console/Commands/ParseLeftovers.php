<?php

namespace App\Console\Commands;

use App\Services\ParseXML\LeftoversImporter;
use Illuminate\Console\Command;

class ParseLeftovers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:leftovers';

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
        $this->info('Start parsing Leftovers...');
        $start = microtime(true);
        $url = 'ftp://' . config('ftp.login') . ':' . config('ftp.password') . '@' . config('ftp.server');
        $leftoversImporter = new LeftoversImporter();
        $leftoversImporter->import($url);
        $end = microtime(true);
        $this->info('Parse time:'.$end-$start);
        return Command::SUCCESS;
    }
}
