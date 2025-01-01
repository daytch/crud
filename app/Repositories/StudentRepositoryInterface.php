<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StudentRepositoryInterface
{
    public function all($request): LengthAwarePaginator;
    public function find(int $id): ?Student;
    public function create(array $data): Student;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
