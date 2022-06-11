<?php

namespace App\Console\Commands;

use App\Models\Shift;

class ListShiftsCommand extends TaxiBaseCommand
{
    protected $taxi_command = "shift:list";
    protected $taxi_command_description = "list shifts";

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
        $this->tableArray(Shift::all()->toArray());
        return 0;
    }
}
