<?php

namespace JayThakkar\OpenPayroll\Processors\Deduction;

use JayThakkar\OpenPayroll\Contracts\CalculateContract;
use JayThakkar\OpenPayroll\Traits\MakeInstance;

class BaseDeductionProcessor implements CalculateContract
{
    use MakeInstance;

    public function getModel()
    {
        return config('open-payroll.models.deduction');
    }

    public function deduction($deduction)
    {
        return $this->instance($deduction);
    }

    public function calculate()
    {
    }
}
