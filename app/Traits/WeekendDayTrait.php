<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 1/3/19
 * Time: 12:16 PM
 */

namespace App\Traits;

use DateTime;

/**
 * Trait WeekendDayTrait
 * @package App\Traits
 */
trait WeekendDayTrait
{
    /**
     * Check whether the day is weekend or not
     *
     * @param DateTime $day
     * @return bool
     */
    private function dayIsWeekend(DateTime $day): bool
    {
        return $day->format('N') >= 6;
    }
}
