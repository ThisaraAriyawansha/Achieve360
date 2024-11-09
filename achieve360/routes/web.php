<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegistrationController;


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


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register_member', [RegistrationController::class, 'register']);
