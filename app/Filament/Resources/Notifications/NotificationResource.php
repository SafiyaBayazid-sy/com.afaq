<?php

namespace App\Filament\Resources\Notifications;

use App\Filament\Resources\Notifications\NotificationResource\Pages\CreateNotification;
use App\Filament\Resources\Notifications\NotificationResource\Pages\EditNotification;
use App\Filament\Resources\Notifications\NotificationResource\Pages\ListNotifications;
use App\Filament\Resources\Notifications\NotificationResource\Pages\ViewNotification;
use App\Models\Notification;
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
use Filament\Forms\Components\TextInput;
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

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 42;

    protected static ?string $modelLabel = 'Notification';

    protected static ?string $pluralModelLabel = 'Notifications';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Notification Details')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('type')
                            ->maxLength(255),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Toggle::make('is_read')
                            ->default(false),

                        Textarea::make('message')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Notification Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('id')->badge(),
                        \Filament\Infolists\Components\TextEntry::make('user.name')->label('User'),
                        \Filament\Infolists\Components\TextEntry::make('type')->placeholder('N/A'),
                        \Filament\Infolists\Components\IconEntry::make('is_read')->boolean(),
                        \Filament\Infolists\Components\TextEntry::make('title'),
                        \Filament\Infolists\Components\TextEntry::make('message')->columnSpanFull(),
                        \Filament\Infolists\Components\TextEntry::make('created_at')->dateTime('Y-m-d H:i:s'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('type')
                    ->placeholder('N/A')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('message')
                    ->limit(50),
                IconColumn::make('is_read')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_read')
                    ->options([
                        1 => 'Read',
                        0 => 'Unread',
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
                            query: $livewire->getTableQueryForExport()->with('user'),
                            fileName: 'notifications-' . now()->format('Y-m-d_H-i-s') . '.csv',
                            headings: [
                                'ID',
                                'User',
                                'Type',
                                'Title',
                                'Message',
                                'Read',
                                'Created At',
                                'Updated At',
                            ],
                            mapRecord: fn (Notification $record): array => [
                                $record->id,
                                $record->user?->name,
                                $record->type,
                                $record->title,
                                $record->message,
                                $record->is_read,
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
            'index' => ListNotifications::route('/'),
            'create' => CreateNotification::route('/create'),
            'view' => ViewNotification::route('/{record}'),
            'edit' => EditNotification::route('/{record}/edit'),
        ];
    }
}
