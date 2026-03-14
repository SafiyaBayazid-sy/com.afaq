<?php

namespace App\Filament\Resources\Campaigns\MarketingCampaignResource\Pages;

use App\Filament\Resources\Campaigns\MarketingCampaignResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMarketingCampaign extends ViewRecord
{
    protected static string $resource = MarketingCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
