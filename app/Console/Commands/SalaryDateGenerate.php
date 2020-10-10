<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SalaryDateGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:salary-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates Salary Dates for a Given Period of Months';

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
        return 0;
    }
}
