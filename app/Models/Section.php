<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Section extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "m_sections";

     protected $fillable = [
        'class_id',
        'section',
        'short_name',
        'status',
        'added_by',
        'updated_by',
    ];

    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id');
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
