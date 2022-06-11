<?php

namespace App\Console\Commands;

use App\Models\CarModel;

class AddCarModelCommand extends TaxiBaseCommand
{
    protected $taxi_command = "car_model:add";
    protected $taxi_command_description = "add a new car model.";

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
        CarModel::create([
            "model_name" => $this->ask("What is the car's model name?"),
            "model_description" => $this->ask("What is the car's model name?")
        ]);
        $this->afterInsertPrint(ListCarModelCommand::class);
        return 0;
    }
}
