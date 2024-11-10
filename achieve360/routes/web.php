<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CourseController;
use App\Http\Controller\ManagerController;
use App\Http\Controllers\CourseAssignmentController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
})->name('login');


// Super Admin Dashboard
Route::get('superadmindashboard', function () {
    return view('super_admin_dashboard'); 
})->name('superadmindashboard')->middleware('auth');


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
