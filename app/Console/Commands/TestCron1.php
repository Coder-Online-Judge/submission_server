<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\JudgeService;


class TestCron1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Server 2 Running");
        \Log::info("Judge Cron Server 1 Running");
        return 0;
    }
}
