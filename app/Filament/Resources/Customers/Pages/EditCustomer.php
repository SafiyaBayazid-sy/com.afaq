<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function mount($record): void
    {
        parent::mount($record);

        // Ensure the user relationship is loaded
        if ($this->record && !$this->record->relationLoaded('user')) {
            $this->record->load('user');
        }
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update the user relationship data
        if (isset($data['user'])) {
            $user = $record->user;
            if ($user) {
                $user->update($data['user']);
            }
        }

        // Remove user data from customer data array
        unset($data['user']);

        // Update customer data
        $record->update($data);

        return $record;
    }
}
