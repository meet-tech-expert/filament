<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table = "m_academic_years";

    protected $fillable = [
        'from_date',
        'to_date',
        'status',
    ];
}
