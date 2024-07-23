<?php

namespace App\Console\Commands;

use App\Services\ParseXML\SKUImporter;
use Illuminate\Console\Command;

class ParseSKU extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:sku';

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
        $this->info('Start parsing SKU...');
        $start = microtime(true);
        $url = 'ftp://' . config('ftp.login') . ':' . config('ftp.password') . '@' . config('ftp.server');
        $skuImporter = new SKUImporter();
        $skuImporter->import($url);
        $end = microtime(true);
        $this->info('Parse time:'.$end-$start);
        return Command::SUCCESS;
    }
}
