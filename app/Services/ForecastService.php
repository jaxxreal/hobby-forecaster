<?php

namespace App\Services;

use DateTime;
use DateInterval;
use App\Utils\DateTimeUtils;

class ForecastService
{
    public function predictCostForNumberOfStudies($initialNumberOfStudiesPerDay, $monthlyGrowth, $monthsHorizon)
    {
        $COST_1GB_RAM_PER_HOUR = 0.00553; // The cost of 1GB of RAM per hour is 0.00553 USD
        $RAM_PER_STUDY_MB = 0.5;
        $STORAGE_PER_STUDY_MB = 10;

        $STORAGE_VALUE = 1000;
        $COST_1GB_STORAGE_PER_MONTH = 0.1;

        $result = [];
        $end_result = [];
        $date = new DateTime();

        for ($i = 0; $i < $monthsHorizon; $i++)
        {
            $date->add(new DateInterval('P1M'));
            $daysInCurrentMonth = DateTimeUtils::calDaysInMonth(date("m", $date->getTimestamp()), date("Y", $date->getTimestamp()));
            $prevMonthStudiesNumber = $i != 0 ? $result[$i - 1]->numberOfStudiesPerDay : $initialNumberOfStudiesPerDay;
            $prevVolumeOfStudiesPerMonthMb = $i != 0 ? $result[$i - 1]->volumeOfStudiesPerMonthMb : 0;

            $numberOfStudiesPerDay = $prevMonthStudiesNumber + $prevMonthStudiesNumber * ($monthlyGrowth / 100);
            
            // We only need to have enough RAM for one day of study.
            $ramPerDayMb = $numberOfStudiesPerDay * $RAM_PER_STUDY_MB;
            $ramPerDayCost = ($ramPerDayMb / 1000) * $COST_1GB_RAM_PER_HOUR;

            // Studies are kept indefinitely. 1 study use 10 MB of storage. 1 GB of storage cost 0.10 USD per month.
            $numberOfStudiesPerMonth = $numberOfStudiesPerDay * $daysInCurrentMonth;
            $volumeOfStudiesPerMonthMb = $numberOfStudiesPerMonth * $STORAGE_PER_STUDY_MB;

            $storagePerMonthCost = (($volumeOfStudiesPerMonthMb + $prevVolumeOfStudiesPerMonthMb) / 1000) * $COST_1GB_STORAGE_PER_MONTH;

            $month = date('M', $date->getTimestamp());
            $year = date('Y', $date->getTimestamp());
            $costPerMonth = $ramPerDayCost + $storagePerMonthCost;

            $subResult = (object) [
                "numberOfStudiesPerDay" => $numberOfStudiesPerDay,
                "volumeOfStudiesPerMonthMb" => $volumeOfStudiesPerMonthMb,
                "numberOfStudiesPerMonth" => $numberOfStudiesPerMonth,
                "costPerMonth" => $costPerMonth,
                "timestamp" => "{$month} {$year}",
                "daysInCurrentMonth" => $daysInCurrentMonth
            ];

            $result[$i] = $subResult;

            $end_result[$i] = (object) [
                "numberOfStudiesPerMonth" => round($numberOfStudiesPerMonth),
                "costPerMonth" => round($costPerMonth, 2),
                "timestamp" => "{$month} {$year}",
            ];
        }

        return $end_result;
    }
}