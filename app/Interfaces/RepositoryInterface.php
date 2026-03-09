<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all records
     * 
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a record by ID
     * 
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Find records matching conditions
     * 
     * @param array $conditions
     * @return Collection
     */
    public function findWhere(array $conditions): Collection;

    /**
     * Find first record matching conditions
     * 
     * @param array $conditions
     * @return Model|null
     */
    public function findWhereFirst(array $conditions): ?Model;

    /**
     * Paginate records
     * 
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Create a new record
     * 
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update a record
     * 
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete a record
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Eager load relationships
     * 
     * @param array|string $relations
     * @return self
     */
    public function with(array|string $relations): self;
}