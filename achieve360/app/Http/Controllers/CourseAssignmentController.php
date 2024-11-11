<?php

namespace App\Http\Controllers;

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
    $course = DB::table('assigned_courses')->where('id', $id)->first();

    if ($course) {
        // Delete the course
        DB::table('assigned_courses')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Course not found']);
    }
}





}
