<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditSubject extends EditRecord
{
    protected static string $resource = SubjectResource::class;

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

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
