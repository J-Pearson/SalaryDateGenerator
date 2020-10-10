<?php

namespace App\Repositories;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class SalaryDateRepository
{
    public function generateDatesForPeriod($period, $value) {
    	$value = (int) $value;
    	if($period == 'months') {
    		return $this->generateDatesForMonthlyPeriods($value);
    	}
    }

    private function generateDatesForMonthlyPeriods($months) {

    	$dates = [];

    	// Get todays date
    	$today = Carbon::now();

    	if ($this->lastDayOfMonth($today)) {
    		$months = $months - 1;
    		$start = $today->startOfMonth()->addMonth();
    	} else {
    		$start = $today->startOfMonth();
    	}

    	$list_of_months = $this->getListOfMonths($start, $months);

    	foreach ($list_of_months as $key => $month) {
    		$last_day = $this->getLastWorkingDay(Carbon::parse($month)->endOfMonth()->startOfDay());
    		$bonus_day = $this->getBonusDay(Carbon::parse($month)->startOfMonth()->addDays(9)->startOfDay());

    		// Current Month
    		$dates[] = [
    			'period' => $key,
    			'basic_payment' => $last_day->toDateString(),
    			'bonus_payment' => $bonus_day->toDateString(),
    		];
    	}

    	return $dates;
    }

    private function lastDayOfMonth($today) {
    	if($today == $today->isSameDay(Carbon::now()->endOfMonth())) {
    		return true;
    	}

    	return false;
    }

    private function getLastWorkingDay($day) {
    	if($this->isHoliday($day)) {
    		return $day = $this->getLastWorkingDay($day->subDay(1));
    	} elseif($this->isWeekend($day)) {
    		if ($day->format('l') == 'Sunday') {
    			return $day = $day->subDays(2);
    		} elseif ($day->format('l') == 'Saturday') {
    			return $day = $day->subDays(1);
    		}
    	} 
    	return $day;
    }

     private function getBonusDay($day) {
    	if($this->isWeekend($day)) {
    		if ($day->format('l') == 'Sunday') {
    			return $day = $day->addDays(1);
    		} elseif ($day->format('l') == 'Saturday') {
    			return $day = $day->addDays(2);
    		}
    	} 
    	return $day;
    }

    private function isWeekend($day) {
    	if ($day->format('l') == Carbon::SATURDAY || $day->format('l') == Carbon::SUNDAY) {
    		return true;
    	}

    	return false;
    }

    private function isHoliday($day) {
    	$holidays = ['31/10'];

    	if(in_array($day->format('d/m'), $holidays)) {
    		return true;
    	}

    	return false;
    }

    private function getListOfMonths($start, $months) {
    	
    	foreach (CarbonPeriod::create($start->toDateString(), $start->addMonths($months)->toDateString())->months() as $month) {
            $dates[$month->format('m/Y')] = $month->format('F Y');
        }
        return $dates;
    }
}