<?php

namespace App\Console\Commands;

use App\Models\Cab;
use App\Models\Driver;

class AddDriverCommand extends TaxiBaseCommand
{
    protected $taxi_command = "driver:add";
    protected $taxi_command_description = "add a new driver.";

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
        $cabs = Cab::all();

        if($cabs->isEmpty()){
            $this->error("Please add a cab first!");
            return 1;
        }

        $manufacturer_name = $this->choice('What is your cab manufacturer?',collect($cabs)->map(function (Cab $cab){
            return $cab->manufacturer_name;
        })->toArray());
        $license_plate = $this->choice('What is your cab model license_plate?',collect($cabs)->where("manufacturer_name", $manufacturer_name)->map(function (Cab $cab){
            return $cab->license_plate;
        })->toArray());
        $cab_id = $cabs->where("manufacturer_name", $manufacturer_name)->where("license_plate", $license_plate)->first()->id;

        Driver::create([
            "first_name" => $this->ask("What is the driver's first name?"),
            "last_name" => $this->ask("What is the driver's last name?"),
            "cab_id" => $cab_id
        ]);
        $this->afterInsertPrint(ListDriverCommand::class);
        return 0;
    }
}
