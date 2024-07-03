<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $table = 'm_months';

    protected $fillable = [
        'name',
    ];

    public function fees()
    {
        return $this->belongsToMany(Fee::class, 'm_fees_months', 'month_id', 'fees_id')
                    ->using(FeeMonth::class);
    }

}
