<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\MonthlyPaymentDayServices;
use App\Services\MonthsOfYearServices;
use Exception;
use Illuminate\Console\Command;

/**
 * Class StaffSalaryDateCommand
 * @package App\Console\Commands
 */
class StaffSalaryDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:export_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to export the date for 
        monthly and bonus salary of staff';

    /**
     * @var MonthsOfYearServices $monthsOfYearServices
     */
    private $monthsOfYearServices;

    /**
     * @var MonthlyPaymentDayServices $monthlyPaymentDayServices
     */
    private $monthlyPaymentDayServices;

    /**
     * StaffSalaryDateCommand constructor.
     * @param MonthsOfYearServices $monthsOfYearServices
     * @param MonthlyPaymentDayServices $monthlyPaymentDayServices
     */
    public function __construct(
        MonthsOfYearServices $monthsOfYearServices,
        MonthlyPaymentDayServices $monthlyPaymentDayServices
    ) {
        parent::__construct();
        $this->monthsOfYearServices = $monthsOfYearServices;
        $this->monthlyPaymentDayServices = $monthlyPaymentDayServices;
    }

    /**
     * Accept file name and return downloaded file
     *
     * @return bool
     * @throws Exception
     */
    public function handle(): bool
    {
        $fileName = $this->ask('Enter the fileName');

        if(empty($fileName)) {
            $this->error('File name cannot be left blank!');

            return false;
        }

        $this->handleCsvExport($fileName);

        return true;
    }

    /**
     * Process the date and save in file
     *
     * @param $fileName
     * @return bool
     * @throws Exception
     */
    private function handleCsvExport($fileName): bool
    {
        if (strpos($fileName, '.csv') === false) {
            $fileName .= '.csv';
        }

        $csvHeaders = [
            ['Month', 'Salary Payment day', 'Bonus Payment day']
        ];

        $path = storage_path('app/StaffSalaryData/');

        $csv = fopen($path . $fileName, 'w');

        foreach ($csvHeaders as $item) {
            fputcsv($csv, $item);
        }

        $remainingMonths = $this->monthsOfYearServices->getRemainingMonthsOfYear();

        $paymentDetails = $this->monthlyPaymentDayServices->getAllMonthPaymentDates($remainingMonths);

        foreach($paymentDetails as $details) {
            foreach ($details as $item) {
                fputcsv($csv, $item);
            }
        }

        fclose($csv);

        $this->info('Salary Details for coming months is downloaded successfully in file ' . $fileName);

        return true;
    }
}
