<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ClassSubjectResource\Pages;
use App\Models\ClassSubject;
use App\Models\ClassMaster;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Set;

class ClassSubjectResource extends Resource
{
    protected static ?string $model = ClassSubject::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'ClassSubject';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('id')
                        ->label('ID')
                        ->required()
                        ->disabled()
                        ->hidden(),
                    BelongsToSelect::make('class_id')
                        ->label('Select Class')
                        ->relationship('classMaster', 'class')
                        ->required(),
                    CheckboxList::make('sub_id')
                        ->label('Select Subjects')
                        ->options(function () {
                            return Subject::pluck('sub_name', 'id')->toArray();
                        })
                        ->columns(2)
                        ->searchable()
                        ->searchPrompt('Search for a subject')
                        ->noSearchResultsMessage('No subject found.')
                        ->bulkToggleable()
                        ->gridDirection('row')
                        ->required(),
                    Toggle::make('status')
                        ->label('Active')
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
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('classMaster.name')
                    ->label('Class')
                    ->sortable(),
                TextColumn::make('subjects')
                    ->label('Subjects')
                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {
                        return implode(', ', $record->subjects->pluck('sub_name')->toArray());
                    }),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
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
            'index' => Pages\ListClassSubjects::route('/'),
            'create' => Pages\CreateClassSubject::route('/create'),
            'edit' => Pages\EditClassSubject::route('/{record}/edit'),
        ];
    }
}
