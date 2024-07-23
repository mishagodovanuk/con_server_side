<?php

namespace App\Console\Commands;


use App\Services\ParseXML\ParseSettlements;
use Illuminate\Console\Command;

class SettlementsSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:settlements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Settlements';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start parsing');
        $settlements = new ParseSettlements();
        $settlements->parse();
        $this->info('Success');
    }
}
