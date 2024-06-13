<?php

namespace App\Filament\Resources\ClassMasterResource\Pages;

use App\Filament\Resources\ClassMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassMasters extends ListRecords
{
    protected static string $resource = ClassMasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
