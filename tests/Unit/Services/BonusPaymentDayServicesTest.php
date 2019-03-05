<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 4/3/19
 * Time: 6:34 PM
 */

namespace Tests\Unit\Services;

use App\Services\BonusPaymentDayServices;
use DateTime;
use Tests\TestCase;

/**
 * Class BonusPaymentDayServicesTest
 * @package Tests\Unit\Services
 */
class BonusPaymentDayServicesTest extends TestCase
{
    /**
     * Test testGetBonusPayday returns proper response
     */
    public function testGetBonusPayday()
    {
        $bonusPaymentDay = new BonusPaymentDayServices();

        $expectedResult = 'Friday 15th';
        $actualResult = $bonusPaymentDay->getBonusPayday(new DateTime());

        $this->assertEquals($expectedResult, $actualResult);
    }
}
