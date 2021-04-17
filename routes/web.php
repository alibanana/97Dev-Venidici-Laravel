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


/* DEFAULT ROUTINGS FROM LARAVEL-BREEZE */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
/* END OF DEFAULT ROUTINGS FROM LARAVEL-BREEZE */


/* START OF CLIENT ROUTING */
Route::get('/', function () {
    return view('client/index');
});
/* END OF CLIENT ROUTING */


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

/* TESTIMONY ROUTING */
Route::get('/admin/testimonies', function () {
    return view('admin/testimony/index');
});
Route::get('/admin/testimonies/create', function () {
    return view('admin/testimony/create');
});
Route::get('/admin/testimonies/1/update', function () {
    return view('admin/testimony/update');
});
/* END OF TESTIMONY ROUTING */


/* TRUSTED COMPANY ROUTING */
Route::get('/admin/trusted-companies', function () {
    return view('admin/trusted-company/index');
});
Route::get('/admin/trusted-companies/create', function () {
    return view('admin/trusted-company/create');
});
Route::get('/admin/trusted-companies/1/update', function () {
    return view('admin/trusted-company/update');
});
/* END OF TRUSTED COMPANY ROUTING */

/* END OF ADMIN ROUTING */

require __DIR__.'/auth.php';
