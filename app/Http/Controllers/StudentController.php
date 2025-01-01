<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    // Fetch all students
    public function index(Request $request)
    {
        // Pass the request object to the repository method
        $students = $this->studentRepository->all($request);
        return response()->json($students);
    }

    // Show a single student by ID
    public function show($id)
    {
        $student = $this->studentRepository->find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // Create a new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'age' => 'required|integer',
        ]);

        $student = $this->studentRepository->create($validated);

        return response()->json($student, 201);
    }

    // Update a student
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $id,
            'age' => 'required|integer',
        ]);

        $updated = $this->studentRepository->update($id, $validated);

        if (!$updated) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json(['message' => 'Student updated successfully']);
    }

    // Delete a student
    public function destroy($id)
    {
        $deleted = $this->studentRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
