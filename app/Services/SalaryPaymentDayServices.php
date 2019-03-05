<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 1/3/19
 * Time: 12:14 PM
 */

namespace App\Services;

use App\Traits\WeekendDayTrait;
use DateTime;

/**
 * Class SalaryPaymentDayServices
 * @package App\Services
 */
class SalaryPaymentDayServices
{
    use WeekendDayTrait;

    /**
     * Fetch the salary day
     *
     * @param DateTime $dateTime
     * @return string|null
     */
    public function getSalaryPaymentDay(DateTime $dateTime): ?string
    {
        $lastDay = $dateTime->modify('last day of this month');

        if ($this->dayIsWeekend($lastDay)) {
            $lastDay = $lastDay->modify('previous friday');
        }

        return $lastDay->format('l jS');
    }
}
