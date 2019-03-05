<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 1/3/19
 * Time: 12:21 PM
 */

namespace App\Services;

use App\Traits\WeekendDayTrait;
use DateTime;

/**
 * Class BonusPaymentDayServices
 * @package App\Services
 */
class BonusPaymentDayServices
{
    use WeekendDayTrait;

    /**
     * Fetch the bonus day
     *
     * @param DateTime $dateTime
     * @return string|null
     */
    public function getBonusPayday(DateTime $dateTime): ?string
    {
        $bonusDay = $dateTime->modify('first day of this month')->modify('+14 days');
        if ($this->dayIsWeekend($bonusDay)) {
            $bonusDay = $bonusDay->modify('next wednesday');
        }

        return $bonusDay->format('l jS');
    }
}
