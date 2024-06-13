<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MBranchResource\Pages;
use App\Filament\Resources\MBranchResource\RelationManagers;
use App\Models\MBranch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MBranchResource extends Resource
{
    protected static ?string $model = MBranch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListMBranches::route('/'),
            'create' => Pages\CreateMBranch::route('/create'),
            'edit' => Pages\EditMBranch::route('/{record}/edit'),
        ];
    }
}
