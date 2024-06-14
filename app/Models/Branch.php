<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "m_branches";

    protected $fillable = [
        'class_id',
        'branch_name',
        'status',
        'added_by',
        'updated_by',
    ];
    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id');
    }

    // Relationship with User (Added By)
    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relationship with User (Updated By)
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

