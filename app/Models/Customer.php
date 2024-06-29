<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivityCustom;

class Customer extends Model
{
    use HasFactory,LogsActivityCustom;   
}
