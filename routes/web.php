<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Client\OnlineCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HomepageController as AdminHomepageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OnlineCourseController as AdminOnlineCourseController;
use App\Http\Controllers\Admin\OnlineCourseUpdateController as AdminOnlineCourseUpdateController;
use App\Http\Controllers\Admin\CourseCategoryController as AdminCourseCategoryController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\AssessmentController as AdminAssessmentController;
use App\Http\Controllers\Admin\HashtagController as AdminHashtagController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Client\CartController;

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





Route::post('/dashboard', [PagesController::class, 'storeInterest'])->name('store_interest');
Route::get('/dashboard', [PagesController::class, 'dashboard_index'])->name('customer.dashboard');

//Route::get('/dashboard', function () {
    //return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
/* END OF DEFAULT ROUTINGS FROM LARAVEL-BREEZE */

/*
|--------------------------------------------------------------------------
| Client Routes
|
| Controllers can be found inside -> App\Http\Controllers\Client\
| Controllers Used:
|   - PagesController
|   - CartController
|--------------------------------------------------------------------------
*/
Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/signup-interests', [PagesController::class, 'signup_interest'])->name('signup_interest');
Route::post('/signup-interests', [PagesController::class, 'storeGeneralInfo'])->name('store_general_info');

/* START OF CLIENT ROUTING */
Route::get('/autocomplete', [PagesController::class, 'autocomplete'])->name('autocomplete');

Route::get('/login', function () {
    return view('client/auth/login');
});
Route::get('/signup', function () {
    return view('client/auth/signup');
});
//Route::get('/signup-interests', function () {
    //return view('client/auth/signup-interests');
//});


//Route::get('/cart', function () {
    //return view('client/cart');
//});
// Route::get('/dashboard', function () {
//     return view('client/user-dashboard');
// });
/* CART ROUTING */
Route::get('/createPayment', [CartController::class, 'createPayment'])->name('customer.cart.createPayment');
Route::get('/getBankStatus', [CartController::class, 'getBankStatus'])->name('customer.cart.getBankStatus');
Route::get('/cart', [CartController::class, 'index'])->name('customer.cart.index');
Route::get('/shipping', [CartController::class, 'shipment_index'])->name('customer.cart.shipment_index');
Route::get('/payment', [CartController::class, 'payment_index'])->name('customer.cart.payment_index');
Route::post('/cart', [CartController::class, 'store'])->name('customer.cart.store');
Route::get('/cart/total', [CartController::class, 'getCartTotal'])->name('customer.cart.total');
Route::get('/cart/totalWeight', [CartController::class, 'getCartTotalWeight'])->name('customer.cart.getCartTotalWeight');
Route::post('/cart/remove/{id}', [CartController::class, 'removeCart'])->name('customer.cart.remove');
Route::post('/cart/removeAll', [CartController::class, 'removeAllCart'])->name('customer.cart.removeAll');
Route::post('/update-to-cart', [CartController::class, 'updatetocart'])->name('customer.updatetocart');
Route::put('/increase-qty', [CartController::class, 'increaseQty'])->name('customer.increaseQty');
Route::put('/decrease-qty', [CartController::class, 'decreaseQty'])->name('customer.decreaseQty');

//})->middleware('auth');

// Route::get('/shipping', function () {
//     return view('client/cart-shipping');
// });

/* START OF ONLINE COURSE ROUTING */
Route::get('/online-course', [OnlineCourseController::class, 'index'])->name('online-course.index');
Route::get('/online-course/{id}', [OnlineCourseController::class, 'show'])->name('online-course.show');

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

Route::get('/transaction-detail/1', function () {
    return view('client/transaction-detail');
});

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
|   - OnlineCourseController
|   - OnlineCourseUpdateController // Update is separated because its very complex.
|   - CourseCategoryController
|   - HashtagController
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    // DashboardController
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/cms/homepage', [AdminHomepageController::class, 'index'])->name('cms.homepage.index');
    // HomepageController
    Route::put('/cms/homepage/top-section', [AdminHomepageController::class, 'updateTopSection'])->name('cms.homepage.top-section.update');
    Route::put('/cms/homepage/trusted-company', [AdminHomepageController::class, 'updateTrustedCompany'])->name('cms.homepage.trusted-company.update');
    Route::get('/cms/homepage/testimonies/{id}/update/{flag}', [AdminHomepageController::class, 'editTestimonies'])->name('cms.homepage.testimonies.edit');
    Route::put('/cms/homepage/testimonies/{id}', [AdminHomepageController::class, 'updateTestimonies'])->name('cms.homepage.testimonies.update');
    // UserController
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    // OnlineCourseController
    Route::get('/online-courses', [AdminOnlineCourseController::class, 'index'])->name('online-courses.index');
    Route::get('/online-courses/create', [AdminOnlineCourseController::class, 'create'])->name('online-courses.create');
    Route::get('/online-courses/{id}', [AdminOnlineCourseController::class, 'show'])->name('online-courses.show');
    Route::post('/online-courses', [AdminOnlineCourseController::class, 'store'])->name('online-courses.store');
    Route::delete('/online-course/{id}', [AdminOnlineCourseController::class, 'destroy'])->name('online-courses.destroy');
    Route::post('/online-courses/{id}/set-publish-status-to-opposite', [AdminOnlineCourseController::class, 'setPublishStatusToOpposite'])->name('online-courses.set-publish-status-to-opposite');
    // OnlineCourseUpdateController
    Route::get('/online-courses/{id}/update', [AdminOnlineCourseUpdateController::class, 'edit'])->name('online-courses.edit');
    Route::put('/online-courses/{id}', [AdminOnlineCourseUpdateController::class, 'update'])->name('online-courses.update');
    // CourseCategoryController
    Route::get('/course-categories', [AdminCourseCategoryController::class, 'index'])->name('course-categories.index');
    Route::post('/course-categories', [AdminCourseCategoryController::class, 'store'])->name('course-categories.store');
    Route::put('/course-categories/{id}', [AdminCourseCategoryController::class, 'update'])->name('course-categories.update');
    Route::delete('/course-categories/{id}', [AdminCourseCategoryController::class, 'destroy'])->name('course-categories.destroy');
    // TeacherController
    Route::get('/teachers', [AdminTeacherController::class, 'index'])->name('teachers.index');
    // AssestmentController
    Route::get('/assessments', [AdminAssessmentController::class, 'index'])->name('assessments.index');
    Route::get('/assessments/create', [AdminAssessmentController::class, 'create'])->name('assessments.create');
    Route::post('/assessments', [AdminAssessmentController::class, 'store'])->name('assessments.store');
    Route::post('/assessments/{id}/questions', [AdminAssessmentController::class, 'storeQuestion'])->name('assessments.store-question');
    Route::get('/assessments/{id}/update', [AdminAssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{id}', [AdminAssessmentController::class, 'updateBasicInfo'])->name('assessments.update-basic-info');
    Route::put('/assessments/{assessment_id}/questions/{question_id}', [AdminAssessmentController::class, 'updateQuestion'])->name('assessments.update-question');
    Route::delete('/assessments/{id}', [AdminAssessmentController::class, 'destroy'])->name('assessments.destroy');
    Route::delete('/assessments/{assessment_id}/questions/{question_id}', [AdminAssessmentController::class, 'destroyQuestion'])->name('assessments.destroy-question');
    // HashtagController
    Route::get('/hashtags', [AdminHashtagController::class, 'index'])->name('hashtags.index');
    Route::get('/hashtags/create', [AdminHashtagController::class, 'create'])->name('hashtags.create');
    Route::post('/hashtags', [AdminHashtagController::class, 'store'])->name('hashtags.store');
    Route::get('/hashtags/{id}/update', [AdminHashtagController::class, 'edit'])->name('hashtags.edit');
    Route::put('/hashtags/{id}', [AdminHashtagController::class, 'update'])->name('hashtags.update');
    Route::delete('/hashtags/{id}', [AdminHashtagController::class, 'destroy'])->name('hashtags.destroy');
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

/* START OF INFORMATION CODE*/
Route::get('/admin/information', function () {
    return view('admin/information/index');
});
Route::get('/admin/information/create', function () {
    return view('admin/information/create');
});
Route::get('/admin/information/1/update', function () {
    return view('admin/information/update');
});
/* END OF INFORMATION CODE */

/* START OF ONLINE COURSE ROUTING */
Route::get('/admin/online-courses/create-video/1', function () {
    return view('admin/online-course/create-video');
});
Route::get('/admin/online-courses/assesments/1', function () {
    return view('admin/assessment/detail');
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


/* START OF NEWS LETTER ROUTING */
Route::get('/admin/newsletter', function () {
    return view('admin/newsletter/index');
});
/* END OF NEWS LETTER ROUTING */


/* END OF ADMIN ROUTING */

/* START OF GOOGLE AUTH */
Route::get('login/google', [App\Http\Controllers\SocialController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\SocialController::class, 'handleGoogleCallback']);
/* END OF GOOGLE AUTH*/


/* START OF FOR PUBLIC ROUTING */
Route::get('/for-public/online-course', function () {
    return view('client/for-public/online-course');
});
Route::get('/for-public/woki', function () {
    return view('client/for-public/woki');
});
/* END OF FOR PUBLIC ROUTING*/

/* START OF FOR CORPORATE ROUTING */
Route::get('/for-corporate/krest', function () {
    return view('client/for-corporate/krest');
});
/* END OF FOR CORPORATE ROUTING*/


Route::get('/email/verifyUser', function () {
    return view('emails/verifyUser');
});
Route::get('/certificate', function () {
    return view('client/certificate');
});
/* START OF DOMPDF ROUTING */
Route::get('/certificate/pdf', [PagesController::class, 'print'])->name('print_pdf');

/* END OF DOMPDF ROUTING */


require __DIR__.'/auth.php';
