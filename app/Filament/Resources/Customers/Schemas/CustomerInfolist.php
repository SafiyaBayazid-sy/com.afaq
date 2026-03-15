<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // User Information Section
                Section::make('User Information')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Name')
                            ->badge()
                            ->color('primary'),
                            
                        TextEntry::make('user.email')
                            ->label('Email')
                            ->copyable()
                            ->copyMessage('Email copied!')
                            ->icon('heroicon-m-envelope'),
                            
                        IconEntry::make('user.is_active')
                            ->label('Active Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                    ])
                    ->columns(3),
                
                // Customer Information Section
                Section::make('Customer Information')
                    ->schema([
                        TextEntry::make('phone')
                            ->icon('heroicon-m-phone')
                            ->copyable()
                            ->copyMessage('Phone copied!'),
                            
                        TextEntry::make('source')
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
                            
                        TextEntry::make('user_id')
                            ->label('User ID')
                            ->badge()
                            ->color('gray'),
                    ])
                    ->columns(3),
                
                // Timestamps Section
                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime('Y-m-d H:i:s')
                            ->icon('heroicon-m-calendar'),
                            
                        TextEntry::make('updated_at')
                            ->dateTime('Y-m-d H:i:s')
                            ->icon('heroicon-m-arrow-path'),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }
}