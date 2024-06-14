<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicYearResource\Pages;
use App\Filament\Resources\AcademicYearResource\RelationManagers;
use App\Models\AcademicYear;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Rules\FromDateBeforeToDate;
use Filament\Forms\Components\Section;


class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Academic Year';
    protected static ?int $navigationSort = 1;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([ 
                Forms\Components\TextInput::make('id')
                    ->label('ID')
                    ->required()
                    ->disabled()
                    ->hidden(),
                Forms\Components\DatePicker::make('from_date')
                    ->label('From Date')
                    ->format('m/Y')
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('to_date')
                    ->label('To Date')
                    ->native(false)
                    ->required()
                    ->afterOrEqual('from_date'),
                Forms\Components\Toggle::make('status')
                    ->label('Active')
                    ->onColor(config('constants.statusIconColor.on.color'))
                    ->offColor(config('constants.statusIconColor.off.color'))
                    ->onIcon(config('constants.statusIconColor.on.icon'))
                    ->offIcon(config('constants.statusIconColor.off.icon'))
                    // ->helperText("Your full name here, including any middle names.")
                    ->default(0)
                    ->inline(), 
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('from_date')->date(),
                Tables\Columns\TextColumn::make('to_date')->date(),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                 '1' => 'Active',
                  '0' => 'Inactive',
                ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicYears::route('/'),
            'create' => Pages\CreateAcademicYear::route('/create'),
            'edit' => Pages\EditAcademicYear::route('/{record}/edit'),
        ];
    }
}
