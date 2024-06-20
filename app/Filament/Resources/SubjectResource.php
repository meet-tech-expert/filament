<?php

namespace App\Filament\Resources;
use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\BooleanColumn;



class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Subject';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Radio::make('group')
                        ->label('Subject Categories')
                        ->options(config('constants.typeGroup'))
                        ->required()
                        ->default(1)
                        ->inline()
                        ->live()
                        ->inlineLabel(false),
                    TextInput::make('sub_code')
                            ->maxLength(5)
                            ->label('Subject Code'),
                    Select::make('parent_subject')
                        ->label('Parent Subject')
                        ->relationship('parentSubject', 'sub_name')
                        ->nullable()
                        ->searchable()
                        ->preload(),

                    TextInput::make('sub_name')
                            ->maxLength(50)
                            ->label('Subject Name')
                            ->required(),
                    TextInput::make('order')
                            ->default(1)
                            ->numeric()
                            ->label('Order')
                            ->required(),

                    Toggle::make('status')
                            ->label('Status')
                            ->onColor(config('constants.statusIconColor.on.color'))
                            ->offColor(config('constants.statusIconColor.off.color'))
                            ->onIcon(config('constants.statusIconColor.on.icon'))
                            ->offIcon(config('constants.statusIconColor.off.icon'))
                            ->default(1)
                            ->inline(),



                ])->compact()->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
->columns([
            TextColumn::make('id')->label('ID'),
            TextColumn::make('sub_name')->label('Subject Name'),
            TextColumn::make('sub_code')->label('Subject Code'),
            BooleanColumn::make('status')
                ->label('Status'),

            TextColumn::make('order')->label('Order'),
            TextColumn::make('group')->label('Subject Categories'),
            TextColumn::make('parent_subject')->label('Parent Subject'),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
