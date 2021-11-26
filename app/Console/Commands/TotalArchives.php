<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;

class TotalArchives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
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
     * @return mixed
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");
        $users = DB::table('users')->count();
        $products = DB::table('products')->count();
        $categories = DB::table('categories')->count();
        $today=date('D');
        DB::table('total_archives')->insert(['total_users'=>$users,'total_products'=>$products,'total_categories'=>$categories,'created_day'=>$today]);
        
    }
}
