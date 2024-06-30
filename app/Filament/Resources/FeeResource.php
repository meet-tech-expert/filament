<?php
namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Models\Fee;
use App\Models\FeeMonth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Section;
use App\Models\AcademicYear;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Fee';
    protected static ?string $pluralModelLabel = 'Fee';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([ 
                Section::make([
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
                TextInput::make('type')
                    ->label('Fees Type')
                    ->required()
                    ->maxLength(200),
                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(200),
                Checkbox::make('is_due')
                    ->label('Due Fees Apply?')
                    ->live(),    
                TextInput::make('due_fees')
                    ->label('Due Fees')
                    ->numeric()
                    ->visible(fn ($get) => $get('is_due')),
                Select::make('due_date')
                    ->label('Due Date')
                    ->options(array_combine(range(1, 28), range(1, 28)))
                    ->default(1)
                    ->visible(fn ($get) => $get('is_due')),
                CheckboxList::make('month_id')
                    ->label('Select Months')
                    ->options(config('constants.yearOfMonths'))->columns(2)
                    ->default(function ($record) {
                        return $record ? $record->feeMonths->pluck('month_id')->toArray() : [];
                    }),
                Toggle::make('status')
                    ->label('Status')
                    ->onColor(config('constants.statusIconColor.on.color'))
                    ->offColor(config('constants.statusIconColor.off.color'))
                    ->onIcon(config('constants.statusIconColor.on.icon'))
                    ->offIcon(config('constants.statusIconColor.off.icon'))
                    ->default(1)
                    ->inline(),
                ])    
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

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
                })->sortable()
                    ->searchable(), 

                TextColumn::make('type')
                    ->label('Fees Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->searchable(),

                BooleanColumn::make('is_due')
                    ->label('Due Fees Apply'),

                TextColumn::make('due_fees')
                    ->label('Due Fees')
                    ->formatStateUsing(fn ($state) => number_format($state, 2)),

                BooleanColumn::make('status')
                    ->label('Status')
                    ->trueColor(config('constants.statusIconColor.on.color'))
                    ->falseColor(config('constants.statusIconColor.off.color'))
                    ->trueIcon(config('constants.statusIconColor.on.icon'))
                    ->falseIcon(config('constants.statusIconColor.off.icon'))
                    ->default(true),

                 TextColumn::make('addedByUser.name')
                    ->label('Added By'),

                TextColumn::make('updatedByUser.name')
                    ->label('Updated By'),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFee::route('/create'),
            'edit' => Pages\EditFee::route('/{record}/edit'),
        ];
    }
}
