<?php
declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\BonusPaymentDayServices;
use App\Services\MonthlyPaymentDayServices;
use App\Services\SalaryPaymentDayServices;
use DateTime;
use Mockery;
use Tests\TestCase;

/**
 * Class MonthlyPaymentDayServicesTest
 * @package Tests\Unit\Services
 */
class MonthlyPaymentDayServicesTest extends TestCase
{
    /**
     * Test testGetAllMonthPaymentDatesReturnsCorrectResponse return correct response
     */
    public function testGetAllMonthPaymentDatesReturnsCorrectResponse()
    {
        $expectedResult = [
            [
                [
                    "month" => "March",
                    "salaryDay" => "Friday 29th",
                    "bonusDay" => "Friday 15th"
                ]
            ],
            [
                [
                    "month" => "April",
                    "salaryDay" => "Tuesday 30th",
                    "bonusDay" => "Monday 15th",
                ]
            ],
            [
                [
                    "month" => "June",
                    "salaryDay" => "Friday 28th",
                    "bonusDay" => "Wednesday 19th"
                ]
            ]
        ];

        $mockMonthlyPaymentDay = Mockery::mock(SalaryPaymentDayServices::class);
        $mockBonusPaymentDay = Mockery::mock(BonusPaymentDayServices::class);

        $mockMonthlyPaymentDay->shouldReceive('getSalaryPaymentDay')
            ->withAnyArgs()
            ->atMost()->times(3)
            ->andReturn('Friday 29th', 'Tuesday 30th', 'Friday 28th');

        $mockBonusPaymentDay->shouldReceive('getBonusPayday')
            ->atMost()->times(3)
            ->withAnyArgs()
            ->andReturn('Friday 15th', 'Monday 15th', 'Wednesday 19th');

        $monthlyPaymentDayService = new MonthlyPaymentDayServices($mockMonthlyPaymentDay, $mockBonusPaymentDay);

        $data = [
            new DateTime('midnight'),
            new DateTime('first day of next month'),
            new DateTime('first day of June 2019')
        ];

        $actualResult = $monthlyPaymentDayService->getAllMonthPaymentDates($data);

        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsArray($expectedResult);
    }
}
