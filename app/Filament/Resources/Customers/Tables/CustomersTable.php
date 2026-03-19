<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Models\Customer;
use App\Services\TableCsvExporter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomersTable
{
    private const SOURCE_OPTIONS = [
        'facebook' => 'Facebook',
        'google_ad' => 'Google ad',
        'snapchat' => 'Snapchat',
        'tiktok' => 'Tiktok',
        'friend' => 'Friend',
        'google_search' => 'Google search',
        'other' => 'Other',
    ];

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // User-related columns
                TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable(query: function ($query, $search) {
                        return $query->whereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(query: function ($query, $direction) {
                        return $query->join('users', 'customers.user_id', '=', 'users.id')
                            ->orderBy('users.name', $direction)
                            ->select('customers.*');
                    })
                    ->weight('medium')
                    ->icon('heroicon-m-user'),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(query: function ($query, $search) {
                        return $query->whereHas('user', function ($q) use ($search) {
                            $q->where('email', 'like', "%{$search}%");
                        });
                    })
                    ->icon('heroicon-m-envelope'),

                IconColumn::make('user.is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                // Customer columns
                TextColumn::make('phone')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Phone copied!'),

                TextColumn::make('source')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'facebook' => 'info',
                        'google_ad' => 'success',
                        'snapchat' => 'warning',
                        'tiktok' => 'danger',
                        'friend' => 'gray',
                        'google_search' => 'primary',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),

                // Timestamps
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->icon('heroicon-m-calendar'),

                TextColumn::make('updated_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->icon('heroicon-m-arrow-path'),
            ])
            ->filters([
                TernaryFilter::make('user.is_active')
                    ->label('Active Status')
                    ->placeholder('All customers')
                    ->trueLabel('Active customers')
                    ->falseLabel('Inactive customers')
                    ->queries(
                        true: fn ($query) => $query->whereHas('user', fn ($q) => $q->where('is_active', true)),
                        false: fn ($query) => $query->whereHas('user', fn ($q) => $q->where('is_active', false)),
                    ),

                SelectFilter::make('source')
                    ->options(self::SOURCE_OPTIONS)
                    ->multiple(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
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
                            query: $livewire->getTableQueryForExport()->with('user'),
                            fileName: 'customers-'.now()->format('Y-m-d_H-i-s').'.csv',
                            headings: [
                                'ID',
                                'Name',
                                'Email',
                                'Phone',
                                'Source',
                                'Active',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (Customer $record): array => [
                                $record->id,
                                $record->user?->name,
                                $record->user?->email,
                                $record->phone,
                                self::SOURCE_OPTIONS[$record->source] ?? $record->source,
                                $record->user?->is_active,
                                $record->created_at,
                                $record->updated_at,
                            ],
                        );
                    }),
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
