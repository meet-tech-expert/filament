<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "m_students";

   
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'academic_id',
        'gender',
        'enroll_no',
        'roll_no',
        'admission_type',
        'medium',
        'class_id',
        'branch_id',
        'sec_id',
        'email',
        'dob',
        'date_admission',
        'aadhaar',
        'blood_group',
        'remarks',
        'hobbies',
        'status',
        'added_by',
        'updated_by',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'sec_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
