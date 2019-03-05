<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: shuvkumar
 * Date: 28/2/19
 * Time: 12:44 PM
 */

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

/**
 * Class StaffSalaryDateCommandTest
 * @package Tests\Unit\Console\Commands
 */
class StaffSalaryDateCommandTest extends TestCase
{

    /**
     * Test testConsoleCommand returns proper response
     */
    public function testConsoleCommand()
    {
        $this->artisan('command:export_date')
            ->expectsQuestion('Enter the fileName', 'TestData.csv')
            ->expectsOutput('Salary Details for coming months is downloaded successfully in file TestData.csv');
    }

    /**
     * Test testNoFileNameEntered gives correct message
     */
    public function testNoFileNameEntered()
    {
        $this->artisan('command:export_date')
            ->expectsQuestion('Enter the fileName', '')
            ->expectsOutput('File name cannot be left blank!');
    }

    /**
     * Test testNotAddedFileExtension adds the extension
     */
    public function testNotAddedFileExtension()
    {
        $this->artisan('command:export_date')
            ->expectsQuestion('Enter the fileName', 'TestData')
            ->expectsOutput('Salary Details for coming months is downloaded successfully in file TestData.csv');
    }
}
