<?php

namespace App\Filament\Resources\Bookings\BookingResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    protected static ?string $title = 'Booking History';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),

                TextColumn::make('action')
                    ->badge(),

                TextColumn::make('user.name')
                    ->label('Actor')
                    ->placeholder('System'),

                TextColumn::make('old_status')
                    ->placeholder('-'),

                TextColumn::make('new_status')
                    ->placeholder('-'),

                TextColumn::make('old_booking_date')
                    ->date()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('new_booking_date')
                    ->date()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('old_booking_time')
                    ->time('H:i')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('new_booking_time')
                    ->time('H:i')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('notes')
                    ->wrap()
                    ->placeholder('-'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
