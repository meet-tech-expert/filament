<?php

namespace App\Filament\Resources\FeeResource\Pages;

use App\Filament\Resources\FeeResource;
use Filament\Actions;
use App\Models\Fee;
use App\Models\FeeMonth;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateFee extends CreateRecord
{
    protected static string $resource = FeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['added_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        return $data; 
    }
     protected function afterCreate(): void
    {
        $this->saveFeeMonths($this->record);
    }

    private function saveFeeMonths(Fee $fee)
    {
        $months = $this->form->getState()['month_id'] ?? [];

        $fee->feeMonths()->delete();

        foreach ($months as $month) {
            FeeMonth::create([
                'fees_id' => $fee->id,
                'month_id' => $month,
            ]);
        }
    }
}

