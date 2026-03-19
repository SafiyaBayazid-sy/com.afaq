<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\LeadResource\Pages\CreateLead;
use App\Filament\Resources\Leads\LeadResource\Pages\EditLead;
use App\Filament\Resources\Leads\LeadResource\Pages\ListLeads;
use App\Filament\Resources\Leads\LeadResource\Pages\ViewLead;
use App\Filament\Resources\Leads\LeadResource\RelationManagers\ActivitiesRelationManager;
use App\Models\Lead;
use App\Services\TableCsvExporter;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Lead';

    protected static ?string $pluralModelLabel = 'Leads';

    public static function getNavigationBadge(): ?string
    {
        return (string) Lead::query()->where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Information')
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(30),

                        Select::make('source')
                            ->options(Lead::SOURCES)
                            ->default('manual')
                            ->required(),

                        Select::make('status')
                            ->options(Lead::STATUSES)
                            ->default('new')
                            ->required(),

                        Select::make('assigned_to')
                            ->label('Assigned To')
                            ->relationship('assignee', 'name')
                            ->searchable()
                            ->preload(),

                        Select::make('campaign_id')
                            ->label('Campaign')
                            ->relationship('campaign', 'name')
                            ->searchable()
                            ->preload(),

                        Select::make('customer_id')
                            ->label('Linked Customer')
                            ->relationship('customer', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->full_name}")
                            ->searchable()
                            ->preload(),

                        TextInput::make('external_id')
                            ->maxLength(255),

                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),

                        KeyValue::make('metadata')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Details')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('name')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('email')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('phone')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('source')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('status')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('assignee.name')
                            ->label('Assigned To')
                            ->placeholder('Unassigned'),
                        \Filament\Infolists\Components\TextEntry::make('campaign.name')
                            ->label('Campaign')
                            ->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('customer.full_name')
                            ->label('Linked Customer')
                            ->placeholder('Not linked'),
                        \Filament\Infolists\Components\TextEntry::make('external_id')
                            ->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('received_at')
                            ->dateTime('Y-m-d H:i:s'),
                        \Filament\Infolists\Components\TextEntry::make('last_activity_at')
                            ->dateTime('Y-m-d H:i:s')
                            ->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('notes')
                            ->placeholder('N/A')
                            ->columnSpanFull(),
                        \Filament\Infolists\Components\TextEntry::make('metadata')
                            ->formatStateUsing(fn ($state) => blank($state) ? '{}' : json_encode($state, JSON_UNESCAPED_UNICODE))
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('campaign.name')
                    ->label('Campaign')
                    ->placeholder('N/A')
                    ->toggleable(),

                TextColumn::make('source')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'mobile_app' => 'primary',
                        'website' => 'info',
                        'facebook' => 'warning',
                        'google' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'qualified' => 'info',
                        'converted' => 'success',
                        'lost' => 'gray',
                        default => 'secondary',
                    }),

                TextColumn::make('assignee.name')
                    ->label('Assigned To')
                    ->placeholder('Unassigned')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                TextColumn::make('last_activity_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('source')
                    ->options(Lead::SOURCES),

                SelectFilter::make('status')
                    ->options(Lead::STATUSES),

                SelectFilter::make('campaign_id')
                    ->label('Campaign')
                    ->relationship('campaign', 'name'),

                SelectFilter::make('assigned_to')
                    ->label('Assigned To')
                    ->relationship('assignee', 'name'),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from')->label('From Date'),
                        DatePicker::make('until')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['until'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->recordActions([
                Action::make('status_update')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->schema([
                        Select::make('status')
                            ->options(Lead::STATUSES)
                            ->required(),
                        Textarea::make('note')
                            ->label('Note')
                            ->rows(3),
                    ])
                    ->fillForm(fn (Lead $record) => [
                        'status' => $record->status,
                    ])
                    ->action(function (Lead $record, array $data): void {
                        $currentNotes = (string) ($record->notes ?? '');
                        $newNote = trim((string) ($data['note'] ?? ''));

                        $record->status = $data['status'];

                        if ($newNote !== '') {
                            $record->notes = trim($currentNotes."\n".now()->toDateTimeString().': '.$newNote);
                        }

                        $record->save();
                    }),
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
                            query: $livewire->getTableQueryForExport()->with(['assignee', 'campaign', 'customer.user']),
                            fileName: 'leads-'.now()->format('Y-m-d_H-i-s').'.csv',
                            headings: [
                                'ID',
                                'Name',
                                'Email',
                                'Phone',
                                'Source',
                                'Status',
                                'Assigned To',
                                'Campaign',
                                'Linked Customer',
                                'External ID',
                                'Received At',
                                'Last Activity At',
                                'Created At',
                                'Notes',
                                'Metadata',
                            ],
                            mapRecord: fn (Lead $record): array => [
                                $record->id,
                                $record->name,
                                $record->email,
                                $record->phone,
                                Lead::SOURCES[$record->source] ?? $record->source,
                                Lead::STATUSES[$record->status] ?? $record->status,
                                $record->assignee?->name,
                                $record->campaign?->name,
                                $record->customer?->full_name,
                                $record->external_id,
                                $record->received_at,
                                $record->last_activity_at,
                                $record->created_at,
                                $record->notes,
                                $record->metadata,
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
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
            'create' => CreateLead::route('/create'),
            'view' => ViewLead::route('/{record}'),
            'edit' => EditLead::route('/{record}/edit'),
        ];
    }
}
