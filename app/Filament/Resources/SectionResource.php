<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers;
use App\Models\Section as Msections;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Resource;
use Filament\Tables\Columns;
use Filament\Tables\Actions;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;


class SectionResource extends Resource
{
    protected static ?string $model = Msections::class;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Section';
    protected static ?int $navigationSort = 2;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    BelongsToSelect::make('class_id')
                        ->label('Class')
                        ->relationship('class', 'class')
                        ->required(),

                    TextInput::make('section')
                        ->label('Section')
                        ->required(),

                    TextInput::make('short_name')
                        ->label('Short Name'),

                    Toggle::make('status')
                            ->label('Status')
                            ->onColor(config('constants.statusIconColor.on.color'))
                            ->offColor(config('constants.statusIconColor.off.color'))
                            ->onIcon(config('constants.statusIconColor.on.icon'))
                            ->offIcon(config('constants.statusIconColor.off.icon'))
                            ->default(1)
                            ->inline(),
                ]), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('class.class')
                    ->label('Class'),

                TextColumn::make('section')
                    ->label('Section'),

                TextColumn::make('short_name')
                    ->label('Short Name'),

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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
