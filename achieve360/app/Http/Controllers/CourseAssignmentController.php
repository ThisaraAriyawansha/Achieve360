<?php

namespace App\Http\Controllers;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseAssignmentController extends Controller
{
    public function assignCourse(Request $request)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string',
            'teacher_name' => 'required|string',
        ]);

        // Insert course and teacher names into the 'assigned_courses' table
        DB::table('assigned_courses')->insert([
            'course_name' => $validatedData['course_name'],
            'teacher_name' => $validatedData['teacher_name'],
            'assigned_at' => now(),
        ]);
        return response()->json(['success' => true]);

    }

public function getAssignedCourses()
{
    // Fetch assigned courses (replace with your actual table/model)
    $assignedCourses = DB::table('assigned_courses')->get();
    return response()->json(['courses' => $assignedCourses]);
}



public function deleteAssignedCourse($id)
{
    // Find the course by ID
    $courses = DB::table('assigned_courses')->where('id', $id)->first();

    if ($courses) {
        // Delete the course
        DB::table('assigned_courses')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Course not found']);
    }
}


public function getCourseDetails()
{
    try {
        // Join assigned_courses and courses tables to fetch course details
        $courses = DB::table('assigned_courses')
            ->join('courses', 'assigned_courses.course_name', '=', 'courses.name') // Correct join condition
            ->select(
                'assigned_courses.course_name',
                'assigned_courses.teacher_name',
                'courses.description as course_description'
            )
            ->get();

        // Ensure it returns a JSON array
        return response()->json($courses);
    } catch (\Exception $e) {
        \Log::error('Error fetching course details: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch course details'], 500);
    }
}





}
