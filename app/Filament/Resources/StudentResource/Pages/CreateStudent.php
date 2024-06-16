<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
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
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //$data['user_id'] = auth()->id();
    
        return $data;
    }
 
}
