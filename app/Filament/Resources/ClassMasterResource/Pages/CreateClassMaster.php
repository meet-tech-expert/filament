<?php

namespace App\Filament\Resources\ClassMasterResource\Pages;

use App\Filament\Resources\ClassMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateClassMaster extends CreateRecord
{
    protected static string $resource = ClassMasterResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['added_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        return $data; 
    }

    protected function afterCreate(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
