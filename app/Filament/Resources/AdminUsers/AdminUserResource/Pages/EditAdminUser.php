<?php

namespace App\Filament\Resources\AdminUsers\AdminUserResource\Pages;

use App\Filament\Resources\AdminUsers\AdminUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAdminUser extends EditRecord
{
    protected static string $resource = AdminUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $data['user_type'] = 'admin';

        $record->update($data);

        return $record;
    }
}
