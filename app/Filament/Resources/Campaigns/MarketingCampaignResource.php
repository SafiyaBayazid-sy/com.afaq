<?php

namespace App\Filament\Resources\Campaigns;

use App\Filament\Resources\Campaigns\MarketingCampaignResource\Pages\CreateMarketingCampaign;
use App\Filament\Resources\Campaigns\MarketingCampaignResource\Pages\EditMarketingCampaign;
use App\Filament\Resources\Campaigns\MarketingCampaignResource\Pages\ListMarketingCampaigns;
use App\Filament\Resources\Campaigns\MarketingCampaignResource\Pages\ViewMarketingCampaign;
use App\Models\MarketingCampaign;
use App\Services\TableCsvExporter;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class MarketingCampaignResource extends Resource
{
    protected static ?string $model = MarketingCampaign::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 41;

    protected static ?string $modelLabel = 'Campaign';

    protected static ?string $pluralModelLabel = 'Campaigns';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Campaign Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('platform')
                            ->maxLength(255),

                        TextInput::make('utm_source')
                            ->maxLength(255),

                        TextInput::make('utm_medium')
                            ->maxLength(255),

                        TextInput::make('utm_campaign')
                            ->maxLength(255),

                        TextInput::make('budget')
                            ->numeric(),

                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),

                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Campaign Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('name'),
                        \Filament\Infolists\Components\TextEntry::make('platform')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('utm_source')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('utm_medium')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('utm_campaign')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('budget')->money('USD')->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('start_date')->date()->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('end_date')->date()->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('notes')->placeholder('N/A')->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('platform')->searchable()->placeholder('N/A'),
                TextColumn::make('utm_campaign')->searchable()->placeholder('N/A'),
                TextColumn::make('budget')->money('USD')->sortable(),
                TextColumn::make('start_date')->date()->sortable(),
                TextColumn::make('end_date')->date()->sortable(),
                TextColumn::make('leads_count')
                    ->counts('leads')
                    ->label('Leads')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('platform')
                    ->options(fn () => MarketingCampaign::query()
                        ->whereNotNull('platform')
                        ->pluck('platform', 'platform')
                        ->toArray()),
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
                            query: $livewire->getTableQueryForExport()->withCount('leads'),
                            fileName: 'campaigns-' . now()->format('Y-m-d_H-i-s') . '.csv',
                            headings: [
                                'ID',
                                'Name',
                                'Platform',
                                'UTM Source',
                                'UTM Medium',
                                'UTM Campaign',
                                'Budget',
                                'Start Date',
                                'End Date',
                                'Leads',
                                'Notes',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (MarketingCampaign $record): array => [
                                $record->id,
                                $record->name,
                                $record->platform,
                                $record->utm_source,
                                $record->utm_medium,
                                $record->utm_campaign,
                                $record->budget,
                                $record->start_date,
                                $record->end_date,
                                $record->leads_count,
                                $record->notes,
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
            'index' => ListMarketingCampaigns::route('/'),
            'create' => CreateMarketingCampaign::route('/create'),
            'view' => ViewMarketingCampaign::route('/{record}'),
            'edit' => EditMarketingCampaign::route('/{record}/edit'),
        ];
    }
}
