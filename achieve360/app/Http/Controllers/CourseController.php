<?php

// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;


class CourseController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create the course
        Course::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Course added successfully!');
    }

    public function index()
{
    $courses = Course::all(); // Assuming your courses are stored in the 'courses' table
    return response()->json(['courses' => $courses]);
}

public function teachers()
{
    $teachers = User::where('role', 'teacher')->pluck('full_name', 'id'); // Pluck name and id of the teachers
    return response()->json(['teachers' => $teachers]);
}

}
