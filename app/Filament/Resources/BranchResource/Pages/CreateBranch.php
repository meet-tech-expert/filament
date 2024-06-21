<?php

namespace App\Filament\Resources\BranchResource\Pages;

use App\Filament\Resources\BranchResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;

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
