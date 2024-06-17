<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassMasterResource\Pages;
use App\Models\ClassMaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicYear;


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
                Section::make([ 
                    Forms\Components\TextInput::make('id')
                        ->label('ID')
                        ->required()
                        ->disabled()
                        ->hidden(),
                    TextInput::make('class')
                        ->label('Class')
                        ->placeholder('Class')
                        ->required(),

                    TextInput::make('class_code')
                        ->label('Class Code')
                        ->placeholder('Class code'),

                    TextInput::make('short_name')
                        ->label('Short Name')
                        ->placeholder('Short Name'),

                    BelongsToSelect::make('academic_id')
                        ->label('Academic Year')
                        ->relationship('academicYear', 'from_date')
                        ->options(function () {
                            return AcademicYear::all()->mapWithKeys(function ($academicYear) {
                                $fromDate = date('F Y', strtotime($academicYear->from_date));
                                $toDate = date('F Y', strtotime($academicYear->to_date));
                                $label = "$fromDate - $toDate";
                                return [$academicYear->getKey() => $label];
                            })->toArray();
                        })
                        ->required(),

                    Forms\Components\Toggle::make('status')
                            ->label('Active')
                            ->onColor(config('constants.statusIconColor.on.color'))
                            ->offColor(config('constants.statusIconColor.off.color'))
                            ->onIcon(config('constants.statusIconColor.on.icon'))
                            ->offIcon(config('constants.statusIconColor.off.icon'))
                            ->default(1)
                            ->inline(),   
                ])
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
                ->label('Academic Year')
                ->formatStateUsing(function ($record) {
                    // Assuming $record->academicYear is the related AcademicYear model
                    if ($record->academicYear) {
                        $fromDate = date('F Y', strtotime($record->academicYear->from_date));
                        $toDate = date('F Y', strtotime($record->academicYear->to_date));
                        return "$fromDate - $toDate";
                    } else {
                        return '-';
                    }
                }),    

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
