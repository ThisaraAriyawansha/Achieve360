<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{

    public function getCoursesAndTeachers()
    {
        try {
            $courses = Course::all();  // Fetch all courses
            $teachers = User::where('role', 'teacher')->get();  // Fetch all users with role 'teacher'
    
            return response()->json(['courses' => $courses, 'teachers' => $teachers]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching data: ' . $e->getMessage()], 500);
        }
    }


    

    public function assignCourse(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'teacher_id' => 'required|exists:users,id',
    ]);

    // Assign the course to the teacher (you may need to create a relationship model for this)
    $teacher = User::find($request->teacher_id);
    $teacher->courses()->attach($request->course_id);

    return back()->with('success', 'Course assigned successfully!');
}


}
