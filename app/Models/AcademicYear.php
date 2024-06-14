<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AcademicYear extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'm_academic_years'; 
       protected $fillable = [
        'from_date',
        'to_date',
        'status',
        'added_by',
        'updated_by'
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}