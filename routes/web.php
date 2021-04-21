<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HomepageController as AdminHomepageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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

/*
|--------------------------------------------------------------------------
| Client Routes
|
| Controllers can be found inside -> App\Http\Controllers\Client\
| Controllers Used:
|   - PagesController
|--------------------------------------------------------------------------
*/
Route::get('/', [PagesController::class, 'index'])->name('index');

/* START OF CLIENT ROUTING */
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
|   - HomepageController
|   - UserController
|   - FakeTestimonyController
*/
Route::prefix('admin')->name('admin.')->middleware([])->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/cms/homepage', [AdminHomepageController::class, 'index'])->name('cms.homepage.index');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
});

/* START ADMIN ROUTING */
Route::get('/admin/login', function () {
    return view('admin/auth/login');
});
Route::get('/admin/reviews', function () {
    return view('admin/reviews');
});
Route::get('/admin/forgot-password', function () {
    return view('admin/auth/forgot-password');
});
Route::get('/admin/reset-password', function () {
    return view('admin/auth/reset-password');
});
/* END OF ADMIN ROUTING */

require __DIR__.'/auth.php';
