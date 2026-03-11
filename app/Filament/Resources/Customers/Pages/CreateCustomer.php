<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Extract user data
        $userData = $data['user'] ?? [];
        $userData['user_type'] = 'customer';

        // Remove user data from customer data array
        unset($data['user']);

        // Create user first
        $user = User::create($userData);

        // Create customer with user_id
        $data['user_id'] = $user->id;

        // Reload the customer with user relationship for form
        $customer = parent::handleRecordCreation($data);
        $customer->load('user');

        return $customer;
    }
}
