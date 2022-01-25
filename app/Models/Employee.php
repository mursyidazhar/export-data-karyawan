<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'email',
        'current_salary',
        'photo',
    ];

    protected $appends = [
        'formatted_salary'
    ];

    /**
     * [getFormattedSalaryAttribute description]
     *
     * @return  return $hasil_rupiah
     */
    public function getFormattedSalaryAttribute()
    {
        $hasil_rupiah = "Rp " . number_format($this->current_salary,2,',','.');
        return $hasil_rupiah;
    }
}
