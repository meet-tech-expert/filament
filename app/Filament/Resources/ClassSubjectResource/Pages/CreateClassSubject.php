<?php

namespace App\Filament\Resources\ClassSubjectResource\Pages;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ClassSubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateClassSubject extends CreateRecord
{
    protected static string $resource = ClassSubjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
      $subAry = $data['sub_id'];
      $classId = $data['class_id'];
      $lastCreatedModel = null;
      
      foreach ($subAry as $key => $value) {
         $info['sub_id'] = $value;
         $info['class_id'] = $classId;
         $info['added_by'] = Auth::id();
         $info['updated_by'] = Auth::id();

         $lastCreatedModel = static::getModel()::create($info);
      }

      return $lastCreatedModel;

    }

}