<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MStudentPersonalInfo extends Model
{
    use HasFactory;
    
    protected $table = 'm_student_personal_info';

    protected $fillable = [
        'stu_id',
        'nationality',
        'religion',
        'mother_tongue',
        'caste',
        'subcaste',
        'spectacle',
        'medical_history',
        'height',
        'weight',
        'alergic_to',
        'food_choice',
        'eye_contact',
        'birth_place',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id');
    }
}


