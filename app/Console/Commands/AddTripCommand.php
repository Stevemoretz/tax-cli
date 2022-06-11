<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Models\Shift;
use App\Models\Trip;
use Carbon\Carbon;

class AddTripCommand extends TaxiBaseCommand
{
    protected $taxi_command = "trip:add";
    protected $taxi_command_description = "add a new trip.";

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
        $shifts = Shift::all();

        if($shifts->isEmpty()){
            $this->error("Please add a shift first!");
            return 1;
        }

        Trip::create([
            "destination" => $this->ask("What is the passenger's destination?"),
            "price" => $this->ask("How much would it cost?"),
            "driver_id" => (function (){
                $now = Carbon::now();
                $drivers = Driver::whereHas('shifts', function ($q) use ($now) {
                    return $q->whereTime("shift_start_time","<=" , $now)->whereTime("shift_end_time",">=" , $now);
                })->get();
                if(count($drivers) === 0){
                    $this->error("No drivers are available at this shit!!");
                    return 1;
                }
                $driverName = $this->choice('Who is the driver?',collect($drivers)->map(function (Driver $driver){
                    return $driver->first_name . "--" . $driver->last_name;
                })->toArray());
                [$firstName, $lastName] = explode("--",$driverName);
                return $drivers->where("first_name",$firstName)->where("last_name", $lastName)->first()->id;
            })()
        ]);
        $this->afterInsertPrint(ListTripsCommand::class);
        return 0;
    }
}
