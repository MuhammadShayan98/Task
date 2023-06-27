<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'employee_code',
        'name',
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
