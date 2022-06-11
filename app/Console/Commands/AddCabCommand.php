<?php

namespace App\Console\Commands;

use App\Models\Cab;
use App\Models\CarModel;

class AddCabCommand extends TaxiBaseCommand
{
    protected $taxi_command = "cab:add";
    protected $taxi_command_description = "add a new cab.";

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
        $carModels = CarModel::all();

        if($carModels->isEmpty()){
            $this->error("Please add a car_model first!");
            return 1;
        }

        $model_name = $this->choice('What is your cab model?',collect($carModels)->map(function (CarModel $carModel){
            return $carModel->model_name;
        })->toArray());
        $model_description = $this->choice('What is your cab model description?',collect($carModels)->where("model_name", $model_name)->map(function (CarModel $carModel){
            return $carModel->model_description;
        })->toArray());
        $model_id = $carModels->where("model_name", $model_name)->where("model_description", $model_description)->first()->id;

        Cab::create([
            "manufacturer_name" => $this->ask("What is the cab's manufacturer_name?"),
            "license_plate" => $this->ask("What is the cab's license_plate?"),
            "model_id" => $model_id
        ]);
        $this->afterInsertPrint(ListCabCommand::class);
        return 0;
    }
}
