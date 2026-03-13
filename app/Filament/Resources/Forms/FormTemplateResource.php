<?php

namespace App\Filament\Resources\Forms;

use App\Filament\Resources\Forms\FormTemplateResource\Pages\CreateFormTemplate;
use App\Filament\Resources\Forms\FormTemplateResource\Pages\EditFormTemplate;
use App\Filament\Resources\Forms\FormTemplateResource\Pages\ListFormTemplates;
use App\Models\FormField;
use App\Models\FormTemplate;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class FormTemplateResource extends Resource
{
    protected static ?string $model = FormTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 50;

    protected static ?string $modelLabel = 'Form Template';

    protected static ?string $pluralModelLabel = 'Form Templates';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Template Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set): void {
                                if (blank($state)) {
                                    return;
                                }

                                $set('slug', Str::slug((string) $state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Public API key for this form, e.g. contact-us.'),

                        Select::make('target')
                            ->options([
                                'web' => 'Website',
                                'app' => 'Mobile App',
                                'both' => 'Website + App',
                            ])
                            ->required()
                            ->default('both'),

                        Toggle::make('is_active')
                            ->default(true),

                        DateTimePicker::make('published_at')
                            ->seconds(false)
                            ->helperText('Leave empty to publish immediately when active.'),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('success_message')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Fields')
                    ->schema([
                        Repeater::make('fields')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->cloneable()
                            ->defaultItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('key')
                                    ->required()
                                    ->maxLength(100)
                                    ->regex('/^[a-z0-9_]+$/')
                                    ->helperText('Use lowercase, numbers, and underscores only.'),

                                Select::make('type')
                                    ->required()
                                    ->options(FormField::TYPES)
                                    ->default('text')
                                    ->live(),

                                Toggle::make('is_required')
                                    ->default(false),

                                Toggle::make('is_active')
                                    ->default(true),

                                TextInput::make('placeholder')
                                    ->maxLength(255),

                                Textarea::make('help_text')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                KeyValue::make('options')
                                    ->keyLabel('Value')
                                    ->valueLabel('Label')
                                    ->addActionLabel('Add option')
                                    ->visible(fn ($get): bool => in_array(
                                        $get('type'),
                                        ['select', 'radio', 'multi_select'],
                                        true
                                    ))
                                    ->columnSpanFull(),

                                TextInput::make('min_length')
                                    ->numeric()
                                    ->minValue(0)
                                    ->visible(fn ($get): bool => in_array($get('type'), ['text', 'textarea'], true)),

                                TextInput::make('max_length')
                                    ->numeric()
                                    ->minValue(1)
                                    ->visible(fn ($get): bool => in_array($get('type'), ['text', 'textarea'], true)),

                                TextInput::make('min_value')
                                    ->numeric()
                                    ->visible(fn ($get): bool => $get('type') === 'number'),

                                TextInput::make('max_value')
                                    ->numeric()
                                    ->visible(fn ($get): bool => $get('type') === 'number'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('slug')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('target')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'web' => 'info',
                        'app' => 'warning',
                        default => 'success',
                    }),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('fields_count')
                    ->counts('fields')
                    ->label('Fields')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('submissions_count')
                    ->counts('submissions')
                    ->label('Submissions')
                    ->badge()
                    ->color('success'),

                TextColumn::make('updated_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All templates')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),

                SelectFilter::make('target')
                    ->options([
                        'web' => 'Website',
                        'app' => 'Mobile App',
                        'both' => 'Website + App',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
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
            'index' => ListFormTemplates::route('/'),
            'create' => CreateFormTemplate::route('/create'),
            'edit' => EditFormTemplate::route('/{record}/edit'),
        ];
    }
}
