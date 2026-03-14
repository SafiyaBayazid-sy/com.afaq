<?php

namespace App\Filament\Resources\Leads\LeadResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    protected static ?string $title = 'Timeline / Activity History';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),

                TextColumn::make('activity_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'primary',
                        'ingested' => 'info',
                        'status_changed' => 'warning',
                        'reassigned' => 'success',
                        'webhook_synced' => 'gray',
                        default => 'secondary',
                    }),

                TextColumn::make('user.name')
                    ->label('Actor')
                    ->placeholder('System'),

                TextColumn::make('description')
                    ->wrap()
                    ->placeholder('N/A'),

                TextColumn::make('old_values')
                    ->label('Old Values')
                    ->formatStateUsing(fn ($state) => blank($state) ? '-' : json_encode($state, JSON_UNESCAPED_UNICODE))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('new_values')
                    ->label('New Values')
                    ->formatStateUsing(fn ($state) => blank($state) ? '-' : json_encode($state, JSON_UNESCAPED_UNICODE))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
