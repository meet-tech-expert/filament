<?php

namespace App\Filament\Resources\ClassMasterResource\Pages;

use App\Filament\Resources\ClassMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;


class EditClassMaster extends EditRecord
{
    protected static string $resource = ClassMasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

      protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = Auth::id(); 
        return $data;
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
