<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected  $table = 'employee';

    protected $fillable = [
        'employee_id',
        'checkin',
        'checkout',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
