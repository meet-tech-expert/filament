<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;
    
    protected $table= 'm_student_addresses';

     protected $fillable = [
        'stu_id', 'cur_addres=s', 'cur_city', 'cur_state', 'cur_zip',
        'same_addr', 'per_address', 'per_city', 'per_state', 'per_zip',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id');
    }
}
