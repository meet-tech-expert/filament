<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeMonth extends Model
{
    use HasFactory;

    protected $table = 'm_fees_months';

    protected $fillable = [
        'fees_id',
        'month_id',
    ];

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

}
