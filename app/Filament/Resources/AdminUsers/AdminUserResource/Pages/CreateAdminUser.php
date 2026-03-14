<?php

namespace App\Filament\Resources\AdminUsers\AdminUserResource\Pages;

use App\Filament\Resources\AdminUsers\AdminUserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAdminUser extends CreateRecord
{
    protected static string $resource = AdminUserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_type'] = 'admin';

        $user = parent::handleRecordCreation($data);

        if (method_exists($user, 'assignRole')) {
            try {
                $user->assignRole('admin');
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        return $user;
    }
}
