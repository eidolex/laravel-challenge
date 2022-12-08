<?php

namespace App\Services\InternetServiceProvider;


class Ooredoo implements Operator
{
    public function getOperator(): string
    {
        return 'ooredoo';
    }

    public function getMonthlyFees(): int
    {
        return 150;
    }
}
