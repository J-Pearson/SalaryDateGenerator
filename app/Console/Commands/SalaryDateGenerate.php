<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Libraries\CSV;
use App\Repositories\SalaryDateRepository;

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

        // Ask for user input of Months
        $months = $this->ask('How many months of Salary Dates from today (' . Carbon::now()->format('Y-m-d') . ') would you like to generate?');

        // Check if months is numeric
        if(!is_numeric($months)) {
            $this->error('Month has not been specified');
        }

        $date_repository = new SalaryDateRepository();

        // Go to date repository and generate date for month period
        $dates = $date_repository->generateDatesForPeriod('months', $months);

        // Call Generic repository for saving CSV with intended path in storage foler
        $csv = new CSV();
        $csv_data = $csv->arrayToCsv('exports/salary-dates.csv', $dates);

        // Build headers for CLI output
        $headers = ['period', 'basic_payment', 'bonus_payment'];

        // Print to CLI
        $this->table($headers, $dates);

        // Report CSV is generated and finish
        $this->info('CSV Generated');
    }
}
