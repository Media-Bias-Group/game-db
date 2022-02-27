<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TopicDailyProgress;

class TopicsReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:topics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'referesh progress on daily basis';

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
     * @return mixed
     */
    public function handle()
    {
        
        TopicDailyProgress::truncate();
    }
}
