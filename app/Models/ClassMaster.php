<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMaster extends Model
{
    use HasFactory,SoftDeletes; 

    protected $table = "m_classes";

   
    protected $fillable = [
        'academic_id',
        'class',
        'class_code',
        'short_name',
        'status',
        'added_by',
        'updated_by',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
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