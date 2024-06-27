<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class ClassSubject extends Model
{
    use HasFactory;

    protected $table = 'm_class_subjects';
    
    protected $fillable = [

        'class_id',
        'sub_id',
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
    
    public function classMaster()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'm_class_subjects', 'class_id', 'sub_id')
                    ->withPivot('status', 'added_by', 'updated_by')
                    ->withTimestamps();
    }


}
