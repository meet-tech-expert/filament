<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Subject extends Model
{
      use HasFactory;

      protected $table = 'm_subjects';

      protected $fillable = [
            'group', 
            'sub_name', 
            'sub_code', 
            'parent_subject', 
            'order', 
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

      public function parentSubject()
      {
        return $this->belongsTo(Subject::class, 'parent_subject')->where('parent_subject',null)->where('status','1');
      }
      public function classes()
    {
        return $this->belongsToMany(ClassMaster::class, 'm_class_subjects', 'sub_id', 'class_id')
                    ->withTimestamps()
                    ->withPivot('status', 'added_by', 'updated_by');
    }
    
}
