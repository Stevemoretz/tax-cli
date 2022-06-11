<?php

namespace App\Console\Commands;

use App\Models\CarModel;

class ListCarModelCommand extends TaxiBaseCommand
{
    protected $taxi_command = "car_model:list";
    protected $taxi_command_description = "list car models.";

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
        $this->tableArray(CarModel::all()->toArray());
        return 0;
    }
}
