<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PopularProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'popularproducts:cron';

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
    {/*
        \Log::info("Cron is working fine!");

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        

        $this->info('Demo:Cron Cummand Run successfully!');
        /*
        $this->line('==================');
        $this->line('Running my job at ' . Carbon::now());
        $this->line('Ending my job at ' . Carbon::now());*/
        $count = \DB::table('orders')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
        \Log::info("Today $count users purchased items");
        //  echo "Today $count users pu";
    }
}
