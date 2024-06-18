<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MStudentParents extends Model
{
    use HasFactory;
    protected $table = 'm_student_parents';

    protected $fillable = [
        'stu_id',
        'father_name',
        'mother_name',
        'f_mobile',
        'm_mobile',
        'f_aadhaar',
        'm_aadhaar',
        'f_education',
        'm_education',
        'f_occupation',
        'm_occupation',
        'f_income',
        'm_income',
        'f_designation',
        'm_designation',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id');
    }

}
