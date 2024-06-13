<?php

namespace App\Filament\Resources\MBranchResource\Pages;

use App\Filament\Resources\MBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMBranches extends ListRecords
{
    protected static string $resource = MBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
