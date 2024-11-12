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

    public function viewEnrolledCourses(Request $request)
    {
        $studentEmail = $request->user()->email; // Get logged-in student's email

        $enrolledCourses = Enrollment::where('student_email', $studentEmail)->get();

        // Check if courses are found
        if ($enrolledCourses->isEmpty()) {
            return response()->json(['error' => 'No enrolled courses found.']);
        }

        return response()->json($enrolledCourses);
    }


    public function viewEnrolledCoursesManagement(Request $request)
    {
        // Fetch all enrolled courses with the student's full name
        $enrolledCourses = Enrollment::join('users', 'enrollments.student_email', '=', 'users.email')
            ->select('enrollments.course_name', 'enrollments.teacher_name', 'enrollments.marks', 'enrollments.attendance_count', 'users.full_name')
            ->get();
    
        // Check if courses are found
        if ($enrolledCourses->isEmpty()) {
            return response()->json(['error' => 'No enrolled courses found.']);
        }
    
        // Return the courses with full name of the student
        return response()->json($enrolledCourses);
    }
    



    public function getEnrollments(Request $request)
    {
        // Get the teacher's full name from the query parameter
        $teacherName = $request->query('teacher_name');
    
        // Filter the enrollments based on the teacher's name
        $enrollments = Enrollment::join('users', 'enrollments.student_email', '=', 'users.email')
            ->select('enrollments.course_name', 'enrollments.teacher_name', 'enrollments.marks', 'enrollments.attendance_count', 'users.full_name')
            ->where('enrollments.teacher_name', $teacherName) // Filter by teacher's name passed as query parameter
            ->get();
    
        return response()->json($enrollments);
    }
    
    
    

    
    
}
