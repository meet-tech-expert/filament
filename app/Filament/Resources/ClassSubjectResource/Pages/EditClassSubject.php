<?php

namespace App\Filament\Resources\ClassSubjectResource\Pages;

use App\Filament\Resources\ClassSubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassSubject extends EditRecord
{
    protected static string $resource = ClassSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = Auth::id(); 
        $data['parent_subject'] = (array_key_exists('parent_subject', $data)) ? $data['parent_subject'] : Null;
        return $data;
    }
}
