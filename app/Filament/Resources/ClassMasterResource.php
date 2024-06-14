<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassMasterResource\Pages;
use App\Filament\Resources\ClassMasterResource\RelationManagers;
use App\Models\ClassMaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassMasterResource extends Resource
{
    protected static ?string $model = ClassMaster::class;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Class';
    protected static ?string $pluralModelLabel = 'Class';
   //protected static bool $hasTitleCaseModelLabel = false;

    protected static ?int $navigationSort = 2;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListClassMasters::route('/'),
            'create' => Pages\CreateClassMaster::route('/create'),
            'edit' => Pages\EditClassMaster::route('/{record}/edit'),
        ];
    }
}
