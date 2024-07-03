<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $table = "m_fees";

    protected $fillable = [
        'academic_id',
        'type',
        'description',
        'is_due',
        'due_fees',
        'due_date',
        'status',
        'added_by',
        'updated_by',
    ];

    public function month()
    {
        return $this->belongsToMany(Month::class, 'm_fees_months','fees_id','month_id');
    }

    public function feeMonths()
    {
        return $this->hasMany(FeeMonth::class, 'fees_id');
    }

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

     public function months()
    {
        return $this->belongsToMany(Month::class, 'm_fees_months', 'fees_id', 'month_id')
                ->using(FeeMonth::class);
    }


}
