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
/* START OF CLIENT ROUTING */

Route::get('/', function () {
    return view('client/index');
});
Route::get('/login', function () {
    return view('client/auth/login');
});
Route::get('/signup', function () {
    return view('client/auth/signup');
});

/* START OF ONLINE COURSE ROUTING */
Route::get('/online-course/sertifikat-menjadi-komedian-lucu', function () {
    return view('client/online-course/detail');
});
/* END OF ONLINE COURSE ROUTING */

/* START OF WOKI ROUTING */

Route::get('/woki/sertifikat-menjadi-seniman', function () {
    return view('client/woki/detail');
});
/* END OF WOKI ROUTING */
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
