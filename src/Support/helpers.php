<?php

if (! function_exists('payroll')) {
    function payroll($identifier)
    {
        return \CleaniqueCoders\OpenPayroll\Processors\PayrollProcessor::make($identifier);
    }
}

if (! function_exists('payslip')) {
    function payslip($identifier)
    {
        return \CleaniqueCoders\OpenPayroll\Processors\PayslipProcessor::make($identifier);
    }
}

if (! function_exists('money')) {
    function money(string $country = null)
    {
        return  \CleaniqueCoders\OpenPayroll\Processors\MoneyProcessor::make($country);
    }
}
