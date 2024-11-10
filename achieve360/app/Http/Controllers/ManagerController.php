<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CourseAssignment;


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


    





}
