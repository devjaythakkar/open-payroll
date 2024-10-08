<?php

if (! function_exists('payroll')) {
    function payroll($identifier)
    {
        return \JayThakkar\OpenPayroll\Processors\PayrollProcessor::make($identifier);
    }
}

if (! function_exists('payslip')) {
    function payslip($identifier)
    {
        return \JayThakkar\OpenPayroll\Processors\PayslipProcessor::make($identifier);
    }
}

if(!function_exists('getYesNoClassName')) {
	function getYesNoClassName($value)
	{
		return ($value) ? 'success' : 'danger';
	}	
}