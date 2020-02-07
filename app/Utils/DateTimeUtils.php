<?php

namespace App\Utils;

class DateTimeUtils
{
    public static function calDaysInMonth($month, $year)
    {
        return $month == 2 ? $year % 4 ? 28 : 29 : ($month % 7 % 2 ? 31 : 30);
    }
}
