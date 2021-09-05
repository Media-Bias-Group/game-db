<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use app\Http\Controllers\ApiController;
use \Cache;

class GetDailyTopics extends Command
{
  public $topics=null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:topics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh topics on a daily basis';

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
        $topics=DB::table("sentences")
              ->select("topic")
              ->OrderByRaw("RAND()")
              ->distinct()
              ->limit(7)
              ->get();
          Cache::put('topics', $topics);
   
        return 0;
    }
}
