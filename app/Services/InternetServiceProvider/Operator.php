<?php

namespace App\Services\InternetServiceProvider;


interface Operator {

    public function getOperator(): string;

    public function getMonthlyFees(): int;

}