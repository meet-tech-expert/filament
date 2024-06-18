<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MStudentAcademic extends Model
{
    use HasFactory;

   protected $table = 'm_student_academics';

    public function academicYear()
    {
        return $this->belongsTo(MAcademicYear::class, 'academic_id');
    }

    public function student()
    {
        return $this->belongsTo(MStudent::class, 'student_id');
    }
}