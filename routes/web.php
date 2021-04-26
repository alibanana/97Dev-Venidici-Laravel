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
|   - HomepageController
|   - UserController
*/
Route::prefix('admin')->name('admin.')->middleware([])->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/cms/homepage', [AdminHomepageController::class, 'index'])->name('cms.homepage.index');
    Route::put('/cms/homepage/top-section', [AdminHomepageController::class, 'updateTopSection'])->name('cms.homepage.top-section.update');
    Route::put('/cms/homepage/trusted-company', [AdminHomepageController::class, 'updateTrustedCompany'])->name('cms.homepage.trusted-company.update');
    Route::get('/cms/homepage/testimonies/{id}/update/{flag}', [AdminHomepageController::class, 'editTestimonies'])->name('cms.homepage.testimonies.edit');
    Route::put('/cms/homepage/testimonies/{id}', [AdminHomepageController::class, 'updateTestimonies'])->name('cms.homepage.testimonies.update');
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

/* START OF ONLINE COURSE ROUTING */
Route::get('/admin/online-courses', function () {
    return view('admin/online-course/index');
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
