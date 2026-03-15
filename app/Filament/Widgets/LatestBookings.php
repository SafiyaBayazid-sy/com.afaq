<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestBookings extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Booking::with('customer.user')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('customer.full_name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('booking_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('booking_time')
                    ->label('Time')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (Booking $record): string => $record->status_color),
            ])
            ->paginated(false)
            ->heading('Latest Bookings');
    }
}
