<?php

namespace App\Filament\Resources;

use App\Models\Branch;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Actions;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Pages;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Toggle;
use App\Filament\Resources\BranchResource\Pages as BranchPages;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Branch';
    protected static ?int $navigationSort = 3;
   // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                BelongsToSelect::make('class_id')
                    ->label('Class')
                    ->relationship('class', 'class')
                    ->required(),

                TextInput::make('branch_name')
                    ->label('Branch Name')
                    ->required(),

                  Toggle::make('status')
                            ->label('Status')
                            ->onColor(config('constants.statusIconColor.on.color'))
                            ->offColor(config('constants.statusIconColor.off.color'))
                            ->onIcon(config('constants.statusIconColor.on.icon'))
                            ->offIcon(config('constants.statusIconColor.off.icon'))
                            ->default(1)
                            ->inline(),
                

               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('class.class')
                    ->label('Class'),

                TextColumn::make('branch_name')
                    ->label('Branch Name'),

                
                 
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
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
            'index' => BranchPages\ListBranches::route('/'),
            'create' => BranchPages\CreateBranch::route('/create'),
            'edit' => BranchPages\EditBranch::route('/{record}/edit'),
        ];
    }
}
