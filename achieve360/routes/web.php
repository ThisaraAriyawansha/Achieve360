<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CourseController;
use App\Http\Controller\ManagerController;
use App\Http\Controllers\CourseAssignmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrollmentController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('superadmindashboard', [UserController::class, 'showUsersByRole'])
    ->middleware('auth')
    ->name('superadmindashboard');



//  Admin Dashboard
Route::get('admindashboard', function () {
    return view('admin_dashboard'); 
})->name('admindashboard')->middleware('auth');


//  Manager Dashboard
Route::get('managerdashboard', function () {
    return view('manager_dashboard'); 
})->name('managerdashboard')->middleware('auth');

//  Teacher Dashboard
Route::get('teacherdashboard', function () {
    return view('teacher_dashboard'); 
})->name('teacherdashboard')->middleware('auth');

//  Student Dashboard
Route::get('studentdashboard', function () {
    return view('student_dashboard'); 
})->name('studentdashboard')->middleware('auth');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register_member', [RegistrationController::class, 'register']);

Route::post('/register_course', [CourseController::class, 'store']);

Route::get('/api/courses', [CourseController::class, 'index']);
Route::get('/api/teachers', [CourseController::class, 'teachers']);


Route::post('/assign_course', [CourseAssignmentController::class, 'assignCourse']);


Route::post('/update_status/{id}', [UserController::class, 'updateStatus']);


Route::get('/api/courses', [CourseController::class, 'getAllCourses']);

Route::delete('/api/courses/{id}', [CourseController::class, 'deleteCourse']);

Route::get('/assigned_courses', [CourseAssignmentController::class, 'getAssignedCourses']);


Route::delete('/assigned_courses/{id}', [CourseAssignmentController::class, 'deleteAssignedCourse']);


Route::get('/get-course-details', [CourseAssignmentController::class, 'getCourseDetails'])->name('getCourseDetails');

Route::post('/enroll-course', [EnrollmentController::class, 'enrollInCourse']);

Route::get('/view-enrolled-courses', [EnrollmentController::class, 'viewEnrolledCourses']);

Route::get('/view-enrolled-courses-management', [EnrollmentController::class, 'viewEnrolledCoursesManagement']);


Route::get('/api/enrollments', [EnrollmentController::class, 'getEnrollments']);
