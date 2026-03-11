<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Schemas\Schema; // Change this import
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use UnitEnum;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $modelLabel = 'Setting';

    protected static ?string $pluralModelLabel = 'Settings';

    protected static ?int $navigationSort = 1;

    // Fix the method signature - use Schema instead of Form
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Setting Information')
                    ->schema([
                        TextInput::make('key')
                            ->label('Setting Key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique identifier for this setting'),

                        TextInput::make('label')
                            ->label('Display Label')
                            ->required()
                            ->helperText('Human-readable label for this setting'),

                        Select::make('type')
                            ->label('Data Type')
                            ->options([
                                'text' => 'Text',
                                'number' => 'Number',
                                'boolean' => 'Boolean (True/False)',
                                'json' => 'JSON',
                                'image' => 'Image Upload',
                            ])
                            ->required()
                            ->default('text'),

                        Select::make('group')
                            ->label('Group')
                            ->options([
                                'general' => 'General',
                                'contact' => 'Contact Information',
                                'social' => 'Social Media',
                                'seo' => 'SEO',
                                'appearance' => 'Appearance',
                                'business' => 'Business Info',
                            ])
                            ->required()
                            ->default('general'),

                        Toggle::make('is_public')
                            ->label('Publicly Accessible')
                            ->helperText('Can this setting be accessed on the frontend?')
                            ->default(false),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->helperText('Explain what this setting does'),

                        // You might want to conditionally show different value inputs based on type
                        // For now, using a simple Textarea
                        Textarea::make('value')
                            ->label('Value')
                            ->required()
                            ->helperText('Enter the setting value')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Key')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('group')
                    ->label('Group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'gray',
                        'contact' => 'blue',
                        'social' => 'green',
                        'seo' => 'purple',
                        'appearance' => 'pink',
                        'business' => 'orange',
                        default => 'gray',
                    }),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'number' => 'blue',
                        'boolean' => 'green',
                        'json' => 'purple',
                        'image' => 'orange',
                        default => 'gray',
                    }),

                // You'll need to define an accessor in your Setting model for value_display
                TextColumn::make('value_display')
                    ->label('Value')
                    ->html()
                    ->limit(50),

                ToggleColumn::make('is_public')
                    ->label('Public'),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact Information',
                        'social' => 'Social Media',
                        'seo' => 'SEO',
                        'appearance' => 'Appearance',
                        'business' => 'Business Info',
                    ]),

                SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                        'json' => 'JSON',
                        'image' => 'Image',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
