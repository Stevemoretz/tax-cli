<?php

namespace App\Console\Commands;

use App\Models\Cab;

class ListCabCommand extends TaxiBaseCommand
{
    protected $taxi_command = "cab:list";
    protected $taxi_command_description = "list cabs";

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
        $this->tableArray(Cab::all()->toArray());
        return 0;
    }
}
