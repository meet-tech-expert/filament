<?php

namespace App\Filament\Resources\MSectionResource\Pages;

use App\Filament\Resources\MSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMSection extends EditRecord
{
    protected static string $resource = MSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
