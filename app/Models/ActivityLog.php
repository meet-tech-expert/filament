<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDescriptionAttribute()
    {
        $user = $this->user ? $this->user->name : 'User';
        $model = class_basename($this->auditable_type);

        switch ($this->event) {
            case 'created':
                return "{$model} created by {$user}";
            case 'updated':
                return "{$model} updated by {$user}";
            case 'deleted':
                return "{$model} deleted by {$user}";
            default:
                return "{$model} {$this->event} by {$user}";
        }
    }

     public function getTypeAttribute()
    {
        $accessEvents = ['login'];
        return in_array($this->event, $accessEvents) ? 'Access' : 'Resource';
    }

    public function getModelWithIdAttribute()
    {
        $model = class_basename($this->auditable_type);
        return "{$model}  #{$this->auditable_id}";
    }
}
