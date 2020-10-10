<?php

namespace App\Console\Commands;

use Carbon\Carbon;
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
        $this->info('Generation Started');

        $months = $this->ask('How many months of Salary Dates from today (' . Carbon::now()->format('Y-m-d') . ') would you like to generate?');

        $file_path = storage_path('exports/salary-dates.csv'); 

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $fp = fopen($file_path, 'w+');

        fwrite($fp, 'Test Data');

        fclose($fp);
    }
}
