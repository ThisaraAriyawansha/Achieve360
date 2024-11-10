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
}