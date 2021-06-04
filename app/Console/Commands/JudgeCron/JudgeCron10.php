<?php

namespace App\Console\Commands\JudgeCron;

use Illuminate\Console\Command;

class JudgeCron10 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judge:cron10';

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
       // \Log::info("Judge Cron Server 10 Running");
        (new \App\Services\JudgeService(10))->multiJudge();
        
        return 0;
    }
}
