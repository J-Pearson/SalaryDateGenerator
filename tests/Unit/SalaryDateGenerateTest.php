<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SalaryDateGenerateTest extends TestCase
{
    /** @test */
    public function it_has_salary_date_generate_command()
    {
        $this->assertTrue(class_exists(\App\Console\Commands\SalaryDateGenerate::class));
    }

    public function it_can_print_csv_to_command_output()
    {
		$this->artisan('generate:salary-dates')
			->expectsOutput('Generation Started')
			->expectsQuestion('How many months of Salary Dates from today (' . Carbon::now()->format('Y-m-d') . ') would you like to generate?', '12')
			// Put test here for looking at the results of the CSV, unsure what these will be just yet
			->assertExitCode(0);
    }

    public function it_can_save_generated_csv()
   	{
   		$this->assertTrue(file_exists('/Storage/exports/salary-dates.csv'));
   	} 
}
