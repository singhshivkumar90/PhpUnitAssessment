<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 22/2/19
 * Time: 12:30 PM
 */

namespace App\Services;

use DateTime;

/**
 * Class MonthlyPaymentDayServices
 * @package App\Services
 */
class MonthlyPaymentDayServices
{
    /**
     * @var SalaryPaymentDayServices $salaryPaymentDayServices
     */
    private $salaryPaymentDayServices;

    /**
     * @var BonusPaymentDayServices $bonusPaymentDayServices
     */
    private $bonusPaymentDayServices;


    /**
     * MonthlyPaymentDayServices constructor.
     * @param SalaryPaymentDayServices $salaryPaymentDayServices
     * @param BonusPaymentDayServices $bonusPaymentDayServices
     */
    public function __construct(
        SalaryPaymentDayServices $salaryPaymentDayServices,
        BonusPaymentDayServices $bonusPaymentDayServices
    ) {
        $this->salaryPaymentDayServices = $salaryPaymentDayServices;
        $this->bonusPaymentDayServices = $bonusPaymentDayServices;
    }

    /**
     * Get the payment dates for all remaining months of current year
     *
     * @param $remainingMonths
     * @return array
     */
    public function getAllMonthPaymentDates($remainingMonths): array
    {
        $monthWisePaymentDay = [];

        /** @var DateTime $month */
        foreach($remainingMonths as $month) {
            $salaryDay = $this->salaryPaymentDayServices->getSalaryPaymentDay($month);
            $bonusDay = $this->bonusPaymentDayServices->getBonusPayday($month);

            $monthWisePaymentDay[] = [
                [
                    'month' => $month->format('F'),
                    'salaryDay' => $salaryDay,
                    'bonusDay' => $bonusDay
                ]
            ];
        }

        return $monthWisePaymentDay;
    }
}
