<?php

namespace App\Filament\Resources\Forms;

use App\Filament\Resources\Forms\FormSubmissionResource\Pages\ListFormSubmissions;
use App\Filament\Resources\Forms\FormSubmissionResource\Pages\ViewFormSubmission;
use App\Models\FormSubmission;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 51;

    protected static ?string $modelLabel = 'Form Submission';

    protected static ?string $pluralModelLabel = 'Form Submissions';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submission Details')
                    ->schema([
                        TextEntry::make('id')
                            ->badge(),

                        TextEntry::make('template.name')
                            ->label('Form Template')
                            ->badge()
                            ->color('primary'),

                        TextEntry::make('submitter_name')
                            ->label('Submitted By'),

                        TextEntry::make('customer.user.email')
                            ->label('Customer Email')
                            ->placeholder('N/A'),

                        TextEntry::make('lead_email')
                            ->label('Lead Email')
                            ->placeholder('N/A'),

                        TextEntry::make('lead_phone')
                            ->label('Lead Phone')
                            ->placeholder('N/A'),

                        TextEntry::make('source')
                            ->badge(),

                        TextEntry::make('submitted_at')
                            ->dateTime('Y-m-d H:i:s'),
                    ])
                    ->columns(4),

                Section::make('Answers')
                    ->schema([
                        RepeatableEntry::make('answers')
                            ->schema([
                                TextEntry::make('field_label')
                                    ->label('Field')
                                    ->weight('bold'),

                                TextEntry::make('field_type')
                                    ->label('Type')
                                    ->badge(),

                                TextEntry::make('display_answer')
                                    ->label('Answer')
                                    ->placeholder('No answer'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('template.name')
                    ->label('Form')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('submitter_name')
                    ->label('Submitted By')
                    ->searchable(['lead_name']),

                TextColumn::make('lead_email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('source')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'web' => 'info',
                        'app' => 'warning',
                        'api' => 'gray',
                        default => 'primary',
                    }),

                TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Answers')
                    ->badge()
                    ->color('success'),

                TextColumn::make('submitted_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('form_template_id')
                    ->label('Form')
                    ->relationship('template', 'name'),

                SelectFilter::make('source')
                    ->options([
                        'web' => 'Website',
                        'app' => 'Mobile App',
                        'api' => 'API',
                        'admin' => 'Admin',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc');
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
            'index' => ListFormSubmissions::route('/'),
            'view' => ViewFormSubmission::route('/{record}'),
        ];
    }
}

