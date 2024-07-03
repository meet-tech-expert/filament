<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesStructure extends Model
{
    use HasFactory;

     protected $table = 'm_fees_structures';


     protected $fillable = [
        'academic_id',
        'fees_id',
        'class_id',
        'fees',
        'added_by',
        'updated_by',
    ];
   
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fees_id');
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
