<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 21/2/19
 * Time: 11:35 AM
 */

namespace App\Services;

use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

/**
 * Class MonthsOfYearServices
 * @package App\Services
 */
class MonthsOfYearServices
{
    /**
     * Get the months remaining in current year
     *
     * @return array
     * @throws Exception
     */
    public function getRemainingMonthsOfYear(): array
    {
        $startDate = new DateTime('midnight');
        $endDate = new DateTime('1st january next year');

        $interval = new DateInterval('P1M');
        $nextMonth = new DateTime('first day of next month');
        $period = new DatePeriod($nextMonth, $interval, $endDate);

        $months = array($startDate);

        foreach ($period as $date) {
            array_push($months, $date);
        }

        return $months;
    }
}
