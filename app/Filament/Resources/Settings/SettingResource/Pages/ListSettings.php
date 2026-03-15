<?php

namespace App\Filament\Resources\Settings\SettingResource\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
