<?php

namespace App\Services\InternetServiceProvider;

use Exception;

class WifiInvoiceCaculator
{
    protected $month = 0;

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(Operator $operator)
    {

        return $this->month * $operator->getMonthlyFees();
    }
}
