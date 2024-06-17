<?php

namespace App\Filament\Resources\AcademicYearResource\Pages;

use App\Filament\Resources\AcademicYearResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAcademicYear extends CreateRecord
{
    protected static string $resource = AcademicYearResource::class;

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


