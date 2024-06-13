<?php

namespace App\Filament\Resources\ClassMasterResource\Pages;

use App\Filament\Resources\ClassMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassMaster extends EditRecord
{
    protected static string $resource = ClassMasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
