<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

     protected $table = "m_discounts";

     protected $fillable = [
        'academic_id',
        'type',
        'discount_for',
        'class_id',
        'student_id',
        'discount_type',
        'discount_value',
        'months',
        'remark',
        'status',
        'added_by',
        'updated_by',
    ];
    
    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
