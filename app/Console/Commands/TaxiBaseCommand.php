<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TaxiBaseCommand extends Command
{
    protected $hidden = true;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->signature = "taxi:" . ($this->taxi_command ?? "list");
        $this->description = ($this->taxi_command_description ?? "List");
        if(isset($this->taxi_command)){
            $this->hidden = false;
        }
        parent::__construct();
    }

    public function tableArray(array $array){
        $first = collect($array)->first();
        if($first){
            $this->table(collect($first)->keys()->toArray(),$array);
        }else{
            $this->error("No rows found!");
        }
    }

    public function afterInsertPrint($className){
        $this->info("Now you can run : php artisan taxi:" . app($className)->taxi_command . " to view the data!");
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
