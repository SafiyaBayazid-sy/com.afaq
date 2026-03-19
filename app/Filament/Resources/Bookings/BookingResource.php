<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\BookingResource\Pages\CreateBooking;
use App\Filament\Resources\Bookings\BookingResource\Pages\EditBooking;
use App\Filament\Resources\Bookings\BookingResource\Pages\ListBookings;
use App\Filament\Resources\Bookings\BookingResource\Pages\ViewBooking;
use App\Filament\Resources\Bookings\BookingResource\RelationManagers\HistoriesRelationManager;
use App\Models\Booking;
use App\Services\TableCsvExporter;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;
use UnitEnum;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 30;

    protected static ?string $modelLabel = 'Booking';

    protected static ?string $pluralModelLabel = 'Bookings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking Details')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->full_name}")
                            ->required()
                            ->searchable()
                            ->preload(),

                        DatePicker::make('booking_date')
                            ->required(),

                        TimePicker::make('booking_time')
                            ->seconds(false)
                            ->required(),

                        Select::make('status')
                            ->options([
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('upcoming'),

                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('admin_notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('customer.full_name')
                            ->label('Customer'),
                        \Filament\Infolists\Components\TextEntry::make('booking_date')
                            ->date(),
                        \Filament\Infolists\Components\TextEntry::make('booking_time')
                            ->time('H:i'),
                        \Filament\Infolists\Components\TextEntry::make('status')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('notes')
                            ->placeholder('N/A')
                            ->columnSpanFull(),
                        \Filament\Infolists\Components\TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->placeholder('N/A')
                            ->columnSpanFull(),
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
                TextColumn::make('booking_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('booking_time')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Booking $record) => $record->update(['status' => 'upcoming'])),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Booking $record) => $record->update(['status' => 'cancelled'])),
                Action::make('reschedule')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        DatePicker::make('booking_date')
                            ->required(),
                        TimePicker::make('booking_time')
                            ->seconds(false)
                            ->required(),
                        Textarea::make('admin_notes')
                            ->label('Reschedule Note')
                            ->rows(3),
                    ])
                    ->fillForm(fn (Booking $record) => [
                        'booking_date' => $record->booking_date,
                        'booking_time' => $record->booking_time,
                    ])
                    ->action(function (Booking $record, array $data): void {
                        $record->update([
                            'booking_date' => $data['booking_date'],
                            'booking_time' => $data['booking_time'],
                            'status' => 'upcoming',
                            'admin_notes' => trim((string) ($record->admin_notes."\n".($data['admin_notes'] ?? ''))),
                        ]);
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
                            query: $livewire->getTableQueryForExport()->with('customer.user'),
                            fileName: 'bookings-'.now()->format('Y-m-d_H-i-s').'.csv',
                            headings: [
                                'ID',
                                'Customer',
                                'Booking Date',
                                'Booking Time',
                                'Status',
                                'Notes',
                                'Admin Notes',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (Booking $record): array => [
                                $record->id,
                                $record->customer?->full_name,
                                $record->booking_date,
                                $record->booking_time,
                                ucfirst((string) $record->status),
                                $record->notes,
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
            ->defaultSort('booking_date', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            HistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'view' => ViewBooking::route('/{record}'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
