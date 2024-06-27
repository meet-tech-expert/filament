<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        ActivityLog::create([
            'description' => 'User logged in',
            'causer_id' => $event->user->id,
            'event' => 'login',
            'causer_type' => get_class($event->user),
            'properties' => ['ip' => request()->ip(),'user_agent' => request()->userAgent()],
            'log_name' => 'Logged In',
        ]);
    }
}
