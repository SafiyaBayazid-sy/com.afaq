<?php

namespace App\Services\Api;

use App\Models\Customer;
use App\Repositories\Api\CustomerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class CustomerService
{
    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get all customers with pagination
     */
    public function getAllCustomers(int $perPage = 10)
    {
        return $this->customerRepository->paginateWithUser($perPage);
    }

    /**
     * Get customer by ID
     */
    public function getCustomerById(int $id): ?Customer
    {
        $customer = $this->customerRepository->findWithUser($id);
        
        if (!$customer) {
            throw new InvalidArgumentException("Customer not found with ID: {$id}");
        }
        
        return $customer;
    }

    /**
     * Create new customer
     */
    public function createCustomer(array $data): Customer
    {
        try {
            DB::beginTransaction();

            // Create user record
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_type' => 'customer',
                'is_active' => $data['is_active'] ?? true,
            ];

            $user = \App\Models\User::create($userData);

            // Create customer record
            $customerData = [
                'user_id' => $user->id,
                'budget' => $data['budget'] ?? null,
                'phone' => $data['phone'],
                'source' => $data['source'] ?? null,
                'preferred_property_type' => $data['preferred_property_type'] ?? null,
                'notes' => $data['notes'] ?? null,
            ];

            $customer = $this->customerRepository->create($customerData);

            DB::commit();

            // Load user relationship
            return $customer->load('user');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating customer: ' . $e->getMessage());
            throw new InvalidArgumentException('Failed to create customer: ' . $e->getMessage());
        }
    }

    /**
     * Update existing customer
     */
    public function updateCustomer(int $id, array $data): Customer
    {
        try {
            DB::beginTransaction();

            $customer = $this->customerRepository->findWithUser($id);
            
            if (!$customer) {
                throw new InvalidArgumentException("Customer not found with ID: {$id}");
            }

            // Update user data
            $userData = [];
            
            if (isset($data['name'])) {
                $userData['name'] = $data['name'];
            }
            
            if (isset($data['email'])) {
                $userData['email'] = $data['email'];
            }
            
            if (isset($data['password']) && !empty($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }
            
            if (isset($data['is_active'])) {
                $userData['is_active'] = $data['is_active'];
            }

            if (!empty($userData)) {
                $customer->user->update($userData);
            }

            // Update customer data
            $customerData = [];
            
            if (isset($data['budget'])) {
                $customerData['budget'] = $data['budget'];
            }
            
            if (isset($data['phone'])) {
                $customerData['phone'] = $data['phone'];
            }
            
            if (isset($data['source'])) {
                $customerData['source'] = $data['source'];
            }
            
            if (isset($data['preferred_property_type'])) {
                $customerData['preferred_property_type'] = $data['preferred_property_type'];
            }
            
            if (isset($data['notes'])) {
                $customerData['notes'] = $data['notes'];
            }

            if (!empty($customerData)) {
                $this->customerRepository->update($id, $customerData);
            }

            DB::commit();

            // Refresh and return updated customer
            return $customer->fresh('user');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating customer: ' . $e->getMessage());
            throw new InvalidArgumentException('Failed to update customer: ' . $e->getMessage());
        }
    }

    /**
     * Delete customer
     */
    public function deleteCustomer(int $id): bool
    {
        try {
            DB::beginTransaction();

            $customer = $this->customerRepository->find($id);
            
            if (!$customer) {
                throw new InvalidArgumentException("Customer not found with ID: {$id}");
            }

            // This will cascade delete the user due to foreign key constraint
            $deleted = $this->customerRepository->delete($id);

            DB::commit();

            return $deleted;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting customer: ' . $e->getMessage());
            throw new InvalidArgumentException('Failed to delete customer: ' . $e->getMessage());
        }
    }

    /**
     * Search customers
     */
    public function searchCustomers(string $keyword, int $perPage = 10)
    {
        return $this->customerRepository->search($keyword, $perPage);
    }
}