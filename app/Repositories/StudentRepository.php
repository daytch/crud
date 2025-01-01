<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository implements StudentRepositoryInterface
{
    // Fetch all students with pagination and optional search
    public function all($request): LengthAwarePaginator
    {
        $query = Student::query();

        // Add search functionality if 'search' parameter exists
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Add pagination (default 10 items per page)
        return $query->paginate($request->get('per_page', 10));
    }

    public function find(int $id): ?Student
    {
        return Student::find($id);
    }

    public function create(array $data): Student
    {
        return Student::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $student = $this->find($id);

        if ($student) {
            return $student->update($data);
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $student = $this->find($id);

        if ($student) {
            return $student->delete();
        }

        return false;
    }
}
