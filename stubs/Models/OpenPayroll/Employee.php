<?php

namespace App\Models\OpenPayroll;

use App\Models\User;
use Cleaniquecoders\Profile\Traits\HasProfile;
use Cleaniquecoders\Profile\Traits\Morphs\Bankable;

class Employee extends User
{
    use HasProfile, Bankable;

    protected $table = 'users';

    public function salary()
    {
        return $this->hasOne(Salary::class, 'user_id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'user_id');
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class, 'user_id');
    }
}
