<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\Projects\ProjectResource\Pages\EditProject;
use App\Filament\Resources\Projects\ProjectResource\Pages\ListProjects;
use App\Filament\Resources\Projects\ProjectResource\Pages\ViewProject;
use App\Models\Project;
use App\Services\TableCsvExporter;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 40;

    protected static ?string $modelLabel = 'Project';

    protected static ?string $pluralModelLabel = 'Projects';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price')
                            ->numeric(),

                        Select::make('project_status')
                            ->options([
                                'on_hold' => 'On Hold',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->default('on_hold'),

                        Select::make('project_type')
                            ->options([
                                'renovation' => 'Renovation',
                                'construction' => 'Construction',
                            ]),

                        Select::make('property_type')
                            ->options([
                                'villa' => 'Villa',
                                'building' => 'Building',
                                'floor' => 'Floor',
                                'apartment' => 'Apartment',
                                'land' => 'Land',
                            ]),

                        Toggle::make('is_active')
                            ->default(true),

                        TextInput::make('country')->maxLength(255),
                        TextInput::make('state')->maxLength(255),
                        TextInput::make('city')->maxLength(255),
                        TextInput::make('street')->maxLength(255),
                        TextInput::make('map_location')->maxLength(255),
                        TextInput::make('video_url')->maxLength(255),

                        Textarea::make('description')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('name'),
                        \Filament\Infolists\Components\TextEntry::make('project_status')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('project_type')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('property_type')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('price')->money('USD')->placeholder('N/A'),
                        \Filament\Infolists\Components\IconEntry::make('is_active')->boolean(),
                        \Filament\Infolists\Components\TextEntry::make('description')->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_status')
                    ->badge(),
                TextColumn::make('project_type')
                    ->placeholder('N/A'),
                TextColumn::make('property_type')
                    ->placeholder('N/A'),
                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('project_status')
                    ->options([
                        'on_hold' => 'On Hold',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                    ]),
                SelectFilter::make('is_active')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                Action::make('export_csv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (TableCsvExporter $csvExporter, $livewire): StreamedResponse {
                        if (! $livewire instanceof HasTable) {
                            abort(500, 'CSV export requires a table context.');
                        }

                        return $csvExporter->stream(
                            query: $livewire->getTableQueryForExport(),
                            fileName: 'projects-' . now()->format('Y-m-d_H-i-s') . '.csv',
                            headings: [
                                'ID',
                                'Name',
                                'Status',
                                'Project Type',
                                'Property Type',
                                'Price',
                                'Active',
                                'Country',
                                'State',
                                'City',
                                'Street',
                                'Map Location',
                                'Video URL',
                                'Description',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (Project $record): array => [
                                $record->id,
                                $record->name,
                                $record->project_status,
                                $record->project_type,
                                $record->property_type,
                                $record->price,
                                $record->is_active,
                                $record->country,
                                $record->state,
                                $record->city,
                                $record->street,
                                $record->map_location,
                                $record->video_url,
                                $record->description,
                                $record->created_at,
                                $record->updated_at,
                            ],
                        );
                    }),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
