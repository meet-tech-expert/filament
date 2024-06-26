<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Resources\Pages\Page;
use App\Models\ActivityLog;

class ViewActivityLog extends Page
{
    protected static string $resource = ActivityLogResource::class;
    protected static string $view = 'filament.resources.audit-log-resource.pages.view-audit-log';

    public ActivityLog $record;

    public function mount(ActivityLog $record): void
    {
        $this->record = $record;
    } 
}

