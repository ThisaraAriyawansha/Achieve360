<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function enrollInCourse(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'student_email' => 'required|email',
            'course_name' => 'required|string',
            'teacher_name' => 'required|string',
        ]);

        try {
            // Create a new enrollment record
            Enrollment::create([
                'student_email' => $request->student_email,
                'course_name' => $request->course_name,
                'teacher_name' => $request->teacher_name,
                'marks' => 0, // Default value for marks
                'attendance_count' => 0, // Default value for attendance count
            ]);

            // Return a success response
            return response()->json(['message' => 'Enrollment successful']);
        } catch (\Exception $e) {
            // Return an error response in case of any exception
            return response()->json(['error' => 'There was an error enrolling in the course. Please try again.'], 500);
        }
    }
}
