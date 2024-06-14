<?php

namespace App\Filament\Resources;

use App\Models\Student;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Columns\DateTimeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns;
use Filament\Tables\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\Pages as StudentPages;

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
               
            ])
            ->bulkActions([
               
            ]);

        // return $table
        //     ->columns([
        //         TextColumn::make('first_name')
        //             ->label('First Name'),

        //         TextColumn::make('middle_name')
        //             ->label('Middle Name'),

        //         TextColumn::make('last_name')
        //             ->label('Last Name'),

        //         BelongsToSelect::make('academic_id')
        //             ->label('Academic Year')
        //             ->relationship('academicYear', 'from_date'),

        //         TextColumn::make('gender')
        //             ->label('Gender')
        //             ->format(function ($value) {
        //                 return $value == 1 ? 'Male' : ($value == 2 ? 'Female' : 'TransGender');
        //             })
        //             ->searchable()
        //             ->sortable(),
        //         TextColumn::make('enroll_no')
        //             ->label('Enrollment Number'),

        //         TextColumn::make('roll_no')
        //             ->label('Roll Number'),

        //         TextColumn::make('admission_type')
        //             ->label('Admission Type')
        //             ->getValue(function ($value) {
        //                 return $value == 1 ? 'New' : 'Old';
        //             }),

        //         TextColumn::make('medium')
        //             ->label('Medium')
        //             ->getValue(function ($value) {
        //                 return $value == 1 ? 'English' : 'Hindi';
        //             }),

        //         BelongsToSelect::make('class_id')
        //             ->label('Class')
        //             ->relationship('class', 'class'),

        //         BelongsToSelect::make('branch_id')
        //             ->label('Branch')
        //             ->relationship('branch', 'branch_name'),

        //         BelongsToSelect::make('sec_id')
        //             ->label('Section')
        //             ->relationship('section', 'section'),

        //         TextColumn::make('email')
        //             ->label('Email'),

        //         TextColumn::make('dob')
        //             ->label('Date of Birth')
        //             ->getValue(function ($value) {
        //                 return date('d-M-Y', strtotime($value));
        //             }),

        //         TextColumn::make('date_admission')
        //             ->label('Date of Admission')
        //             ->getValue(function ($value) {
        //                 return date('d-M-Y', strtotime($value));
        //             }),

        //         TextColumn::make('aadhaar')
        //             ->label('Aadhaar Number'),

        //         TextColumn::make('blood_group')
        //             ->label('Blood Group')
        //             ->getValue(function ($value) {
        //                 $bloodGroups = [
        //                     '1' => 'A Negative',
        //                     '2' => 'A Positive',
        //                     '3' => 'B Negative',
        //                     '4' => 'B Positive',
        //                     '5' => 'AB Negative',
        //                     '6' => 'AB Positive',
        //                     '7' => 'O Negative',
        //                     '8' => 'O Positive',
        //                     '99' => 'Other',
        //                 ];
        //                 return isset($bloodGroups[$value]) ? $bloodGroups[$value] : 'Unknown';
        //             }),

        //         TextColumn::make('remarks')
        //             ->label('Remarks'),

        //         TextColumn::make('hobbies')
        //             ->label('Hobbies'),

        //         TextColumn::make('status')
        //             ->label('Status')
        //             ->getValue(function ($value) {
        //                 return $value == 1 ? 'Active' : 'Inactive';
        //             }),

        //         TextColumn::make('addedByUser.name')
        //             ->label('Added By'),

        //         TextColumn::make('updatedByUser.name')
        //             ->label('Updated By'),

        //         DateTimeColumn::make('created_at')
        //             ->label('Created At'),

        //         DateTimeColumn::make('updated_at')
        //             ->label('Updated At'),
        //     ])
        //     ->filters([
        //         //
        //     ])
        //     ->actions([
        //         Actions\EditAction::make(),
        //     ])
        //     ->bulkActions([
        //         Actions\BulkActionGroup::make([
        //             Actions\DeleteBulkAction::make(),
        //         ]),
        //     ]);


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
            'index' => StudentPages\ListStudents::route('/'),
            'create' => StudentPages\CreateStudent::route('/create'),
            'edit' => StudentPages\EditStudent::route('/{record}/edit'),
        ];
    }
}
