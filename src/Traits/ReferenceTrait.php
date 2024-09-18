<?php

namespace JayThakkar\OpenPayroll\Traits;

use JayThakkar\OpenPayroll\Models\Deduction\Type as DeductionType;
use JayThakkar\OpenPayroll\Models\Earning\Type as EarningType;
use JayThakkar\OpenPayroll\Models\Payroll\Status as PayrollStatus;
use JayThakkar\OpenPayroll\Models\Payslip\Status as PayslipStatus;
use Illuminate\Support\Str;

trait ReferenceTrait
{
    public function seedReferences()
    {
        $this->seedPayrollStatuses();
        $this->seedPayslipStatuses();
        $this->seedEarningTypes();
        $this->seedDeductionTypes();
    }

    private function seedPayrollStatuses()
    {
        $data = config('open-payroll.seeds.payroll_statuses');

        foreach ($data as $datum) {
            PayrollStatus::create([
                'name'      => $datum,
                'code'      => Str::kebab($datum),
                'is_locked' => true,
            ]);
        }
    }

    private function seedPayslipStatuses()
    {
        $data = config('open-payroll.seeds.payslip_statuses');

        foreach ($data as $datum) {
            PayslipStatus::create([
                'name'      => $datum,
                'code'      => Str::kebab($datum),
                'is_locked' => true,
            ]);
        }
    }

    private function seedDeductionTypes()
    {
        $data = config('open-payroll.seeds.deduction_types');

        foreach ($data as $datum) {
            DeductionType::create([
                'name'      => $datum,
                'code'      => Str::kebab($datum),
                'is_locked' => true,
            ]);
        }
    }

    private function seedEarningTypes()
    {
        $data = config('open-payroll.seeds.earning_types');

        foreach ($data as $datum) {
            EarningType::create([
                'name'      => $datum,
                'code'      => Str::kebab($datum),
                'is_locked' => true,
            ]);
        }
    }
}
