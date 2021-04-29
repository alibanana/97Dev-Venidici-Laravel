<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PagesController;
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

Route::get('/autocomplete', [PagesController::class, 'autocomplete'])->name('autocomplete');

Route::get('/login', function () {
    return view('client/auth/login');
});
Route::get('/signup', function () {
    return view('client/auth/signup');
});
Route::get('/signup-interests', function () {
    return view('client/auth/signup-interests');
});
Route::get('/dashboard', function () {
    return view('client/user-dashboard');
});
Route::get('/cart', function () {
    return view('client/cart');
});
Route::get('/shipping', function () {
    return view('client/cart-shipping');
});

/* START OF ONLINE COURSE ROUTING */
Route::get('/online-course', function () {
    return view('client/online-course/index');
});
Route::get('/online-course/sertifikat-menjadi-komedian-lucu', function () {
    return view('client/online-course/detail');
});
Route::get('/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1', function () {
    return view('client/online-course/learn');
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
Route::get('/admin/cms/homepage', function () {
    return view('admin/cms/homepage');
});
Route::get('/admin/cms', function () {
    return view('admin/cms/index');
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

/* TESTIMONY ROUTING */
Route::get('/admin/testimonies/create', function () {
    return view('admin/testimony/create');
});
Route::get('/admin/testimonies/1/update', function () {
    return view('admin/testimony/update');
});
/* END OF TESTIMONY ROUTING */

/* START OF PROMO CODE*/
Route::get('/admin/promo', function () {
    return view('admin/promo/index');
});
Route::get('/admin/promo/create', function () {
    return view('admin/promo/create');
});
Route::get('/admin/promo/1/update', function () {
    return view('admin/promo/update');
});
/* END OF PROMO CODE */


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

/* START OF ONLINE COURSE ROUTING */
Route::get('/admin/online-courses', function () {
    return view('admin/online-course/index');
});
Route::get('/admin/online-courses/1', function () {
    return view('admin/online-course/detail');
});
Route::get('/admin/online-courses/create', function () {
    return view('admin/online-course/create');
});
Route::get('/admin/online-courses/create-video/1', function () {
    return view('admin/online-course/create-video');
});
Route::get('/admin/online-courses/1/update', function () {
    return view('admin/online-course/update');
});
Route::get('/admin/admin/course-categories/create', function () {
    return view('admin/online-course/create-category');
});
Route::get('/admin/online-courses/course-categories', function () {
    return view('admin/course-category/index');
});
Route::get('/admin/online-courses/assesments', function () {
    return view('admin/assesment/index');
});
Route::get('/admin/online-courses/assesments/1', function () {
    return view('admin/assesment/detail');
});
Route::get('/admin/online-courses/assesments/create', function () {
    return view('admin/assesment/create');
});
Route::get('/admin/online-courses/assesments/1/update', function () {
    return view('admin/assesment/update');
});

Route::get('/admin/online-courses/teachers', function () {
    return view('admin/teacher/index');
});
Route::get('/admin/online-courses/teachers/create', function () {
    return view('admin/teacher/create');
});
Route::get('/admin/online-courses/teachers/1/update', function () {
    return view('admin/teacher/update');
});
/* END OF ONLINE COURSE ROUTING */

/* START OF ANALYTICS ROUTING */
Route::get('/admin/analytics/online-course', function () {
    return view('admin/analytics/online-course');
});
/* END OF ANALYTICS ROUTING */
/* END OF ADMIN ROUTING */

require __DIR__.'/auth.php';
