<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Auditable;


class Student extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Auditable;

    protected $table = "m_students";

   
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'enroll_no',
        'roll_no',
        'admission_type',
        'medium',
        'classid',
        'branch_id',
        'sec_id',
        'email',
        'dob',
        'date_admission',
        'aadhaar',
        'pen',
        'blood_group',
        'contact_no',
        'phy_challanged',
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
        return $this->belongsTo(ClassMaster::class, 'classid');
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
