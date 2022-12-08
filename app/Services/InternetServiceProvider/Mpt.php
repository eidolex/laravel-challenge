<?php

namespace App\Services\InternetServiceProvider;

class Mpt implements Operator
{
    public function getOperator(): string
    {
        return 'mpt';
    }

    public function getMonthlyFees(): int
    {
        return 200;
    }
}
