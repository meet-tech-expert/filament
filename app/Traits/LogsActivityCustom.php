<?php 

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LogsActivityCustom
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "{$this->getLogName()} has been {$eventName}")
            ->useLogName($this->getLogName());
    }

    protected function getLogName(): string
    {
        return class_basename($this);
    }
}
