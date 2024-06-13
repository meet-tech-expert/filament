<?php

namespace App\Filament\Resources\MClassResource\Pages;

use App\Filament\Resources\MClassResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMClass extends EditRecord
{
    protected static string $resource = MClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
