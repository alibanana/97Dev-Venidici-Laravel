<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FakeTestimonyController;

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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
/* END OF DEFAULT ROUTINGS FROM LARAVEL-BREEZE */


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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Description:
| All routes in the group below has /admin prefix, admin.* name and uses
| ['auth', 'is_admin'] middleware (user must be logged in to access it).
|
| Controllers can be found inside -> App\Http\Controllers\Admin\
| Controllers Used:
|   - DashboardController
|   - UserController
|   - FakeTestimonyController
*/
Route::prefix('admin')->name('admin.')->middleware([])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/testimonies', [FakeTestimonyController::class, 'index'])->name('testimonies.index');
});

/* START ADMIN ROUTING */
Route::get('/admin/login', function () {
    return view('admin/auth/login');
});
Route::get('/admin/forgot-password', function () {
    return view('admin/auth/forgot-password');
});
Route::get('/admin/reset-password', function () {
    return view('admin/auth/reset-password');
});

/* TESTIMONY ROUTING */
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
