<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;


class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;
    protected static ?string $navigationGroup = 'Activity Logs';
    protected static ?string $navigationLabel = 'Activity Log';
    protected static ?int $navigationSort = 2;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Add form fields if necessary
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                BadgeColumn::make('type')->label('Type')
                    ->colors([
                        'success' => fn ($state): bool => $state === 'Resource',
                        'danger' => fn ($state): bool => $state === 'Access',
                    ])
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->type;
                    }),
                TextColumn::make('event')->label('Event')
                        ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),                
                TextColumn::make('description')
                    ->label('Description')
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->description;
                    }),
                TextColumn::make('auditable_id')->label('Subject')
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->model_with_id;
                    }),
                TextColumn::make('user.name')->label('User'),

                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
             ->filters([
                SelectFilter::make('Type')
                ->options(config('constants.typeLogStatus')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
           
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
            'view' => Pages\ViewActivityLog::route('/{record}'), 
        ];
    }
}

