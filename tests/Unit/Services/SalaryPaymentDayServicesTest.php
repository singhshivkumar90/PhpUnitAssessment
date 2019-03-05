<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 1/3/19
 * Time: 1:05 PM
 */

namespace Tests\Unit\Services;

use App\Services\SalaryPaymentDayServices;
use DateTime;
use Tests\TestCase;

/**
 * Class SalaryPaymentDayServicesTest
 * @package Tests\Unit\Services
 */
class SalaryPaymentDayServicesTest extends TestCase
{
    /**
     * Test testGetSalaryPaymentDay returns proper response
     */
    public function testGetSalaryPaymentDay()
    {
        $salaryPaymentDay = new SalaryPaymentDayServices();
        $expectedResult = 'Friday 29th';
        $actualResult = $salaryPaymentDay->getSalaryPaymentDay(new DateTime());

        $this->assertEquals($expectedResult, $actualResult);
    }
}
