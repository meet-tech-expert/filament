<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated with their default values.
        // $statement  = DB::select("SHOW TABLE STATUS LIKE 'm_students'");
        // $nextUserId = $statement[0]->Auto_increment;
        // var_dump($nextUserId);
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Student registered.')
            ->body('The Student has been created successfully.');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $statement  = DB::select("SHOW TABLE STATUS LIKE 'm_students'");
        $nextUserId = $statement[0]->Auto_increment;
        $data['enroll_no'] = config('constants.STU_PREFIX').'_'.date("ym").auth()->id();
        $data['added_by'] = auth()->id();
        $data['updated_by'] = auth()->id();
        
        return $data;
    }
 
}
