<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Fetch students with pagination and search.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->get('search', '');  // Get search query from the request
        $studentsPerPage = $request->get('per_page', 5); // Number of students per page

        // Filter students based on the search query and paginate
        $students = Student::where('name', 'like', "%{$searchQuery}%")
            ->orWhere('email', 'like', "%{$searchQuery}%")
            ->orWhere('phone', 'like', "%{$searchQuery}%")
            ->paginate($studentsPerPage);  // Paginate results

        return response()->json($students);
    }

    /**
     * Create a new student.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:255',
        ]);

        $student = Student::create($data);

        return response()->json($student, 201);
    }

    /**
     * Update a student.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:255',
        ]);

        $student->update($data);

        return response()->json($student);
    }

    /**
     * Delete a student.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
