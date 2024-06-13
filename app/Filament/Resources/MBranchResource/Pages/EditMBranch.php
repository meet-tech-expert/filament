<?php

namespace App\Filament\Resources\MBranchResource\Pages;

use App\Filament\Resources\MBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMBranch extends EditRecord
{
    protected static string $resource = MBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
