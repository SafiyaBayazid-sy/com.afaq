<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\InquiryResource\Pages\CreateInquiry;
use App\Filament\Resources\Inquiries\InquiryResource\Pages\EditInquiry;
use App\Filament\Resources\Inquiries\InquiryResource\Pages\ListInquiries;
use App\Filament\Resources\Inquiries\InquiryResource\Pages\ViewInquiry;
use App\Models\Inquiry;
use App\Services\TableCsvExporter;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
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

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 20;

    protected static ?string $modelLabel = 'Inquiry';

    protected static ?string $pluralModelLabel = 'Inquiries';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry Details')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->full_name}")
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),

                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->default('new'),

                        Textarea::make('message')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        Textarea::make('admin_notes')
                            ->label('Admin Notes')
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
                Section::make('Inquiry Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('customer.full_name')
                            ->label('Customer'),
                        \Filament\Infolists\Components\TextEntry::make('category.name')
                            ->label('Category')
                            ->placeholder('N/A'),
                        \Filament\Infolists\Components\TextEntry::make('status')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('message')
                            ->columnSpanFull(),
                        \Filament\Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->placeholder('N/A')
                            ->columnSpanFull(),
                        \Filament\Infolists\Components\TextEntry::make('created_at')
                            ->dateTime('Y-m-d H:i:s'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('customer.full_name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->placeholder('N/A')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'completed' => 'success',
                        default => 'secondary',
                    }),
                TextColumn::make('message')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('admin_notes')
                    ->label('Admin Notes')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'completed' => 'Completed',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
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
                            query: $livewire->getTableQueryForExport()->with(['customer.user', 'category']),
                            fileName: 'inquiries-'.now()->format('Y-m-d_H-i-s').'.csv',
                            headings: [
                                'ID',
                                'Customer',
                                'Category',
                                'Status',
                                'Message',
                                'Admin Notes',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (Inquiry $record): array => [
                                $record->id,
                                $record->customer?->full_name,
                                $record->category?->name,
                                ucfirst((string) $record->status),
                                $record->message,
                                $record->admin_notes,
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
            'index' => ListInquiries::route('/'),
            'create' => CreateInquiry::route('/create'),
            'view' => ViewInquiry::route('/{record}'),
            'edit' => EditInquiry::route('/{record}/edit'),
        ];
    }
}
