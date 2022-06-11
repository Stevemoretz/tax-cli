<?php

namespace App\Console\Commands;

use App\Models\Driver;

class ListDriverCommand extends TaxiBaseCommand
{
    protected $taxi_command = "driver:list";
    protected $taxi_command_description = "list drivers";

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
        $this->tableArray(Driver::all()->toArray());
        return 0;
    }
}
