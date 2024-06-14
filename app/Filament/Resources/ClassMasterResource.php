<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassMasterResource\Pages;
use App\Models\ClassMaster;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ClassMasterResource extends Resource
{
    protected static ?string $model = ClassMaster::class;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Class';
    protected static ?string $pluralModelLabel = 'Class';
   //protected static bool $hasTitleCaseModelLabel = false;

    protected static ?int $navigationSort = 2;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('class')
                    ->label('Class')
                    ->required(),

                TextInput::make('class_code')
                    ->label('Class Code'),

                TextInput::make('short_name')
                    ->label('Short Name'),

                BelongsToSelect::make('academic_id')
                    ->label('Academic Year')
                    ->relationship('academicYear', 'from_date')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->default('1'),

                BelongsToSelect::make('added_by')
                    ->label('Added By')
                    ->relationship('addedByUser', 'name')
                    ->required(),

                BelongsToSelect::make('updated_by')
                    ->label('Updated By')
                    ->relationship('updatedByUser', 'name')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('class')
                    ->label('Class'),

                TextColumn::make('class_code')
                    ->label('Class Code'),

                TextColumn::make('short_name')
                    ->label('Short Name'),

                TextColumn::make('academicYear.from_date')
                    ->label('Academic Year'),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        return $state == '1' ? 'Active' : 'Inactive';
                    }),

                TextColumn::make('addedByUser.name')
                    ->label('Added By'),

                TextColumn::make('updatedByUser.name')
                    ->label('Updated By'),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ])
            ->filters([
                // Define any filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationships here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassMasters::route('/'),
            'create' => Pages\CreateClassMaster::route('/create'),
            'edit' => Pages\EditClassMaster::route('/{record}/edit'),
        ];
    }
}
