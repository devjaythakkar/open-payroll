<?php

namespace JayThakkar\OpenPayroll\Tests\Database;

use JayThakkar\OpenPayroll\Tests\TestCase;
use JayThakkar\OpenPayroll\Tests\Traits\PayrollTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayslipDatabaseTest extends TestCase
{
    use PayrollTrait, RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->seedPayrollSeeder();
        $this->reseedUsers();
        $this->seedOnePayrollData();
        $this->seedOnePayslipData();
    }

    /** @test */
    public function it_can_insert_payslip_data()
    {
        $this->seedOnePayslipData();
        $this->assertHasOnePayslipData();
    }
}
