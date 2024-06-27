<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Filament\Resources\ActivityLogResource\RelationManagers;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Table\Columns\DateTimeColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\BelongsToSelect;


class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;
    protected static ?string $navigationGroup = 'Activity Logs';
    protected static ?string $navigationLabel = 'Activity Log';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form 
    {
        return $form 
             ->schema([
                Section::make([ 
                    BelongsToSelect::make('causer_id')
                    ->label('User')
                    ->relationship('User', 'name')
                    ->required(),
                    TextInput::make('subject_id')->label('Subject')
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->model_with_id;
                    }),
                    Textarea::make('description')->rows(2),
                ])->columns(2),
                Section::make([ 
                    TextInput::make('type')->label('Type')
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->type;
                    }),
                    TextInput::make('event')->label('Event')
                        ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
                    TextInput::make('created_at')->label('Logged at')->disabled(),
                ])->columns(2),
                Section::make('Properties')
                                ->schema([
                   
                ])->columns(2)     
            ]);
    }

    public static function table(Table $table): Table
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
                TextColumn::make('subject_id')->label('Subject')
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->model_with_id;
                    }),
                TextColumn::make('user.name')->label('User')
                        ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),    
                TextColumn::make('created_at')->label('Logged At')->dateTime(),
            ])
             ->filters([
                SelectFilter::make('Type')
                ->options(config('constants.typeLogStatus')),
            ]);
          
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
            'view' => Pages\ViewActivityLog::route('/{record}'), 
        ];
    }
}
