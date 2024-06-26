<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    public function created($model)
    {
        $this->logChanges($model, 'created');
    }

    public function updated($model)
    {
        $this->logChanges($model, 'updated');
    }

    public function deleted($model)
    {
        $this->logChanges($model, 'deleted');
    }

    public function loggingIn(Login $event)
    {
        $this->logLoginLogout($event->user, 'login');
    }

    public function loggedOut(Logout $event)
    {
        $this->logLoginLogout($event->user, 'logout');
    }

    protected function logChanges($model, $event)
    {
        $auditLog = new ActivityLog([
            'user_id' => optional(auth()->user())->id,
            'event' => $event,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->id,
            'old_values' => $event == 'updated' ? json_encode($model->getOriginal()) : null,
            'new_values' => $event == 'updated' ? json_encode($model->getChanges()) : null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);

        $auditLog->save();
    }

    protected function logLoginLogout($user, $event)
    {
        $auditLog = new ActivityLog([
            'user_id' => $user->id,
            'event' => $event,
            'auditable_type' => $user::class,
            'auditable_id' => $user->id,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);

        $auditLog->save();
    }
}


