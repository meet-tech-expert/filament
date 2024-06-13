<?php

namespace App\Filament\Resources\MStudentResource\Pages;

use App\Filament\Resources\MStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMStudent extends EditRecord
{
    protected static string $resource = MStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
