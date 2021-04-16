<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* START ADMIN ROUTING */
Route::get('/admin/dashboard', function () {
    return view('admin/index');
});
Route::get('/admin/login', function () {
    return view('admin/auth/login');
});
Route::get('/admin/forgot-password', function () {
    return view('admin/auth/forgot-password');
});
Route::get('/admin/reset-password', function () {
    return view('admin/auth/reset-password');
});
Route::get('/admin/users', function () {
    return view('admin/users');
});
/* END OF ADMIN ROUTING */
