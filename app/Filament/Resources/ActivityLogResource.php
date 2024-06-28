<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;
    protected static ?string $navigationGroup = 'Activity Logs';
    protected static ?string $navigationLabel = 'Activity Log';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    BelongsToSelect::make('causer_id')
                        ->label('User')
                        ->relationship('causer', 'name')
                        ->required(),
                    TextInput::make('subject_id')->label('Subject')
                        ->formatStateUsing(function (ActivityLog $record) {
                            return $record->model_with_id;
                        }),
                    Textarea::make('description')->rows(2),
                ])->columns(2),
                Section::make([
                    TextInput::make('type')->label('Type')
                        ->formatStateUsing(function (ActivityLog $record) {
                            return $record->type;
                        }),
                    TextInput::make('event')->label('Event')
                        ->formatStateUsing(function ($state) {
                            return ucfirst($state);
                        }),
                    TextInput::make('created_at')->label('Logged at')->disabled(),
                ])->columns(2),
                Section::make()
                    ->schema(static::getPropertiesFields())
            ]);
    }

    protected static function getPropertiesFields(): array
    {
        return [
            Forms\Components\Fieldset::make('Properties')
                ->schema(function (?ActivityLog $record) {
                    if (!$record || !$record->properties) {
                        return [];
                    }

                    $properties = json_decode($record->properties, true);
                    $fields = static::buildPropertyFields($properties);

                    return $fields;
                })
        ];
    }

    protected static function buildPropertyFields(array $properties, string $prefix = 'properties'): array
    {
        $fields = [];

        foreach ($properties as $key => $value) {
            $fieldKey = $prefix . '.' . $key;
            if (is_array($value)) {
                $fields[] = Forms\Components\Fieldset::make(ucfirst(str_replace('_', ' ', $key)))
                    ->schema(static::buildPropertyFields($value, $fieldKey));
            } else {
                $fields[] = TextInput::make($fieldKey)
                    ->label(ucfirst(str_replace('_', ' ', $key)))
                    ->default((string) $value)
                    ->disabled();
            }
        }

        return $fields;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->label('Type')->badge()->sortable()
                    ->colors([
                        'success' => fn ($state): bool => $state === 'Resource',
                        'danger' => fn ($state): bool => $state === 'Access',
                    ])
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->type;
                    }),
                TextColumn::make('event')->label('Event')->sortable()
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
                TextColumn::make('description')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('subject_id')->label('Subject')->sortable()
                    ->formatStateUsing(function (ActivityLog $record) {
                        return $record->model_with_id;
                    }),
                TextColumn::make('causer.name')->label('User')->sortable()
                    ->formatStateUsing(function ($state) {
                        return ucfirst($state);
                    }),
                TextColumn::make('created_at')->label('Logged At')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options(config('constants.typeLogStatus')),
                SelectFilter::make('log_name')->label('Subject Type')
                    ->options([
                        'ClassMaster' => 'Class Master',
                        'AcademicYear'  => 'Academic Year',
                    ]),
                SelectFilter::make('event')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'login'   => 'Login',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_at')
                            ->placeholder('dd/mm/yyyy')
                            ->label('Logged At')
                            ->maxDate(now())
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_at'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '=', $date),
                            );
                    })->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_at'] ?? null) {
                            $indicators[] = Indicator::make('Logged At: ' . Carbon::parse($data['created_at'])->toFormattedDateString())
                                ->removeField('created_at');
                        }
                        return $indicators;
                    }),
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
            'index' => Pages\ListActivityLogs::route('/'),
            'view' => Pages\ViewActivityLog::route('/{record}'),
        ];
    }
}
