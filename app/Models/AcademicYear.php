<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\Auditable;

class AcademicYear extends Model
{
    use HasFactory,SoftDeletes,Auditable;

    protected $table = 'm_academic_years'; 

    protected $fillable = [
        'from_date',
        'to_date',
        'set_primary',
        'status',
        'added_by',
        'updated_by'
    ];

    protected $dates = [
        'from_date',
        'to_date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->added_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getFormattedFromDateAttribute()
    {
        if ($this->from_date instanceof \DateTime) {
            return $this->from_date->format('F, Y');
        }
        return $this->from_date; 
    }

    public function getFormattedToDateAttribute()
    {
        if ($this->to_date instanceof \DateTime) {
            return $this->to_date->format('F, Y');
        }
        return $this->to_date; 
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}