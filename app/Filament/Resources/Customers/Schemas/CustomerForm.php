<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // User Information Section
                Section::make('User Information')
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->user) {
                                    $component->state($record->user->name);
                                }
                            }),

                        TextInput::make('user.email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique('users', 'email', ignoreRecord: true, modifyRuleUsing: function ($rule, $record) {
                                if ($record && $record->user) {
                                    $rule->ignore($record->user->id);
                                }
                                return $rule;
                            })
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->user) {
                                    $component->state($record->user->email);
                                }
                            }),

                        Toggle::make('user.is_active')
                            ->label('Active')
                            // ->default(fn ($record) => $record?->user?->is_active ?? true)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->user) {
                                    $component->state($record->user->is_active);
                                }
                            }),

                        TextInput::make('user.password')
                            ->label('Password')
                            ->password()
                            ->required(fn ($context) => $context === 'create')
                            ->hidden(fn ($context) => $context === 'edit' && !request()->routeIs('filament.admin.resources.customers.edit'))
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                    ])
                    ->columns(2),

                // Customer Information Section
                Section::make('Customer Information')
                    ->schema([
                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Select::make('source')
                            ->options([
                                'facebook' => 'Facebook',
                                'google_ad' => 'Google ad',
                                'snapchat' => 'Snapchat',
                                'tiktok' => 'Tiktok',
                                'friend' => 'Friend',
                                'google_search' => 'Google search',
                                'other' => 'Other',
                            ])
                            ->required(),

                        // Hidden user_id field (will be set automatically)
                        TextInput::make('user_id')
                            ->hidden()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }
}
