<?php

namespace Database\Seeders;

use JayThakkar\OpenPayroll\Traits\ReferenceTrait;
use Illuminate\Database\Seeder;

class OpenPayrollSeeder extends Seeder
{
    use ReferenceTrait;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seedReferences();
    }
}
