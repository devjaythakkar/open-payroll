<?php

namespace JayThakkar\OpenPayroll\Processors;

use JayThakkar\OpenPayroll\Contracts\CalculateContract;

class PayrollProcessor implements CalculateContract
{
    public $payroll;

    public function __construct($identifier = null)
    {
        $this->payroll = config('open-payroll.models.payroll')::query()
            ->with('payslips', 'payslips.earnings', 'payslips.deductions', 'payslips.employee')
            ->findByHashSlugOrId($identifier);
    }

    public static function make($identifier = null)
    {
        return new self($identifier);
    }

    public function payroll($payroll)
    {
        $this->payroll = $payroll;

        return $this;
    }

    public function calculate()
    {
        $this->payroll->payslips->each(function($payslip) {
            payslip($payslip)->calculate();
        });

        return $this;
    }
}
