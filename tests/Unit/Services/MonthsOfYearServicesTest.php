<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 27/2/19
 * Time: 3:48 PM
 */

namespace Tests\Unit\Services;

use App\Services\MonthsOfYearServices;
use Tests\TestCase;

/**
 * Class MonthsOfYearServicesTest
 * @package Tests\Unit\Services
 */
class MonthsOfYearServicesTest extends TestCase
{
    /**
     * Test testGetRemainingMonthsOfYear is array
     *
     */
    public function testGetRemainingMonthsOfYear()
    {
        $monthsOfYear = new MonthsOfYearServices();
        $actualResult = $monthsOfYear->getRemainingMonthsOfYear();

        $this->assertIsArray($actualResult);
        $this->assertNotEmpty($actualResult);
    }
}
