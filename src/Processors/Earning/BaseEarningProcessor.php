<?php

namespace JayThakkar\OpenPayroll\Processors\Earning;

use JayThakkar\OpenPayroll\Contracts\CalculateContract;
use JayThakkar\OpenPayroll\Traits\MakeInstance;

class BaseEarningProcessor implements CalculateContract
{
    use MakeInstance;

    public function getModel()
    {
        return config('open-payroll.models.earning');
    }

    public function earning($earning)
    {
        return $this->instance($earning);
    }

    public function calculate()
    {
    }
}
