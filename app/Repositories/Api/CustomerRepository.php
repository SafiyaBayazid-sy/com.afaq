<?php

namespace App\Repositories\Api;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    /**
     * Get customers with their user data
     */
    public function getAllWithUser(array $columns = ['*']): Collection
    {
        return $this->model->with('user')->get($columns);
    }

    /**
     * Find customer by ID with user data
     */
    public function findWithUser(int $id): ?Customer
    {
        return $this->model->with('user')->find($id);
    }

    /**
     * Paginate customers with user data
     */
    public function paginateWithUser(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with('user')->paginate($perPage);
    }

    /**
     * Find customer by email
     */
    public function findByEmail(string $email): ?Customer
    {
        return $this->model->whereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
    }

    /**
     * Find customer by phone
     */
     public function findByPhone(string $phone): ?Customer
    {
        return $this->model->with('user') // Added with('user') to load the relationship
            ->where('phone', $phone)
            ->first();
    }

    /**
     * Get active customers
     */
    public function getActiveCustomers(): Collection
    {
        return $this->model->whereHas('user', function ($query) {
            $query->where('is_active', true);
        })->get();
    }

    /**
     * Search customers by name, email, or phone
     */
    public function search(string $keyword, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->where(function ($query) use ($keyword) {
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('email', 'LIKE', "%{$keyword}%");
            })
            ->orWhere('phone', 'LIKE', "%{$keyword}%");
        })
        ->with('user')
        ->paginate($perPage);
    }
}