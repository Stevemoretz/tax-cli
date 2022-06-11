<?php

namespace App\Console\Commands;

use App\Models\Trip;

class ListTripsCommand extends TaxiBaseCommand
{
    protected $taxi_command = "trip:list";
    protected $taxi_command_description = "list trips";

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
        $this->tableArray(Trip::all()->toArray());
        return 0;
    }
}
