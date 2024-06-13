<?php

namespace App\Filament\Resources\MSectionResource\Pages;

use App\Filament\Resources\MSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMSections extends ListRecords
{
    protected static string $resource = MSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
