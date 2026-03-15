<?php

namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findWhere(array $conditions): Collection
    {
        $query = $this->model->newQuery();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                [$operator, $actualValue] = $value;
                $query->where($field, $operator, $actualValue);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function findWhereFirst(array $conditions): ?Model
    {
        $query = $this->model->newQuery();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                [$operator, $actualValue] = $value;
                $query->where($field, $operator, $actualValue);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->first();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function update(int $id, array $data): Model
    {
        return DB::transaction(function () use ($id, $data) {
            $record = $this->find($id);

            if (!$record) {
                throw new InvalidArgumentException("Record with ID {$id} not found");
            }

            $record->update($data);
            return $record->fresh();
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $record = $this->find($id);

            if (!$record) {
                throw new InvalidArgumentException("Record with ID {$id} not found");
            }

            return $record->delete();
        });
    }

    /**
     * This method needs to be handled carefully - we need to return a new instance
     * or use a different approach for fluent interface
     */
    public function with(array|string $relations): self
    {
        // Instead of modifying $this->model, we should return a new instance
        // or use a query builder approach
        $newInstance = clone $this;

        if (is_string($relations)) {
            $relations = [$relations];
        }

        // We need to create a new query with the relations
        $newInstance->model = $this->model->newQuery()->with($relations)->getModel();

        return $newInstance;
    }

    /**
     * Get a new query builder instance
     */
    protected function newQuery(): Builder
    {
        return $this->model->newQuery();
    }
}
