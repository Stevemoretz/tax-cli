<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Models\Shift;

class AddShiftCommand extends TaxiBaseCommand
{
    protected $taxi_command = "shift:add";
    protected $taxi_command_description = "add a new shift.";

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
        $drivers = Driver::all();

        if($drivers->isEmpty()){
            $this->error("Please add a driver first!");
            return 1;
        }

        $driverName = $this->choice('Who is the driver?',collect($drivers)->map(function (Driver $driver){
            return $driver->first_name . "--" . $driver->last_name;
        })->toArray());
        [$firstName, $lastName] = explode("--",$driverName);
        $driverId = $drivers->where("first_name",$firstName)->where("last_name", $lastName)->first()->id;

        do {
            $startTime = $this->ask("What is the shift's start time (eg : 13:15)");
        } while (!preg_match("/^\d{2}:\d{2}$/m", $startTime));

        do {
            $endTime = $this->ask("What is the shift's end time (eg : 23:15)");
        } while (!preg_match("/^\d{2}:\d{2}$/m", $startTime));

        Shift::create([
            "shift_start_time" => $startTime,
            "shift_end_time" => $endTime,
            "driver_id" => $driverId
        ]);
        $this->afterInsertPrint(ListShiftsCommand::class);
        return 0;
    }
}
