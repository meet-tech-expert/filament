<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationGroup = 'Students';
    protected static ?string $navigationLabel = 'Student';

    protected static ?int $navigationSort = 1;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form  
             ->schema([
                    Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Student Details')
                            // ->icon('heroicon-o-credit-card')
                            ->schema([
                                Section::make([
                                    TextInput::make('enroll_no')
                                        ->label('Enroll No')
                                        ->placeholder('stu_xxxxxx')
                                        ->helperText('Enroll No will be auto generated.')
                                        ->disabled(),//->disabledOn('edit')
                                    TextInput::make('first_name')
                                        ->placeholder('First Name')
                                        ->required()
                                        ->maxLength(200),
                                    Select::make('class')
                                        ->options(config('constants.typeClassCode'))
                                        ->native(false)
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                    Radio::make('gender')
                                        ->options(config('constants.typeGender'))
                                        ->required()
                                        ->default(1)
                                        ->inline(),
                                    TextInput::make('aadhaar')
                                        ->label('Aadhaar No')
                                        ->mask('9999-9999-9999')
                                        ->placeholder('Aadhaar No'),    

                                ])->compact()->columnSpan(1),
                                Section::make([
                                    Select::make('academic_id')
                                        ->label('Academic Year')
                                        ->options([ 
                                            1=> 'April 2024 - March 2025',
                                            2 => 'April 2023 - March 2024',
                                            3 => 'April 2022 - March 2023'
                                            ])
                                        ->native(false)
                                        ->required(),
                                    TextInput::make('middle_name')
                                        ->placeholder('Middle Name')
                                        ->maxLength(50),
                                    Select::make('branch')
                                        ->options(config('constants.typeClassCode'))
                                        ->native(false)
                                        ->searchable()
                                        ->preload(),
                                    DatePicker::make('date_of_birth')
                                        ->required()
                                        ->placeholder('Date of birth')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->maxDate(now()),     

                                ])->compact()->columnSpan(1),
                                Section::make([
                                    TextInput::make('roll_no')
                                        ->label('Roll Number')
                                        ->placeholder('Roll Number')
                                        ->numeric(),
                                    TextInput::make('last_name')
                                        ->placeholder('Last Name')
                                        ->required()
                                        ->maxLength(200),
                                    Select::make('section')
                                        ->options(config('constants.typeSection'))
                                        ->native(false)
                                        ->required()
                                        ->preload(),
                                    Select::make('status')
                                        ->options(config('constants.typeStudentStatus'))
                                        ->native(false)
                                        ->default(1)
                                        ->required()
                                        ->preload(),    

                                ])->compact()->columnSpan(1),
                                

                                Section::make([

                                    SpatieMediaLibraryFileUpload::make('photo')
                                        ->collection('student-images')
                                        ->responsiveImages()
                                        ->image()
                                        ->imageEditor()
                                        ->maxSize(250)
                                        ->avatar(), 

                                ])->compact()->columnSpan(1),

                            ])->columns(3),
                        Tabs\Tab::make('Personal Information')
                            //->icon('heroicon-o-globe-alt')
                            ->schema([
                                //start added field here
                            ]),
                        Tabs\Tab::make('Address')
                            //->icon('heroicon-o-globe-alt')
                            ->schema([
                                //start added field here
                            ]),
                        Tabs\Tab::make('Parent Details')
                            //->icon('heroicon-o-globe-alt')
                            ->schema([
                                //start added field here
                            ]),
                    ])->persistTabInQueryString('active-tab'),
                ])->columns(1);
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
