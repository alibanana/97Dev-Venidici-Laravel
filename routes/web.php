<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Client\OnlineCourseController;
use App\Http\Controllers\Client\WokiController;
use App\Http\Controllers\Client\AssessmentController;
use App\Http\Controllers\Client\KrestController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\BootcampController;
use App\Http\Controllers\Client\ContactUsController;
use App\Http\Controllers\Client\CandidateDetailController;
use App\Http\Controllers\Client\JobPortalController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HomepageController as AdminHomepageController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\OnlineCourseController as AdminOnlineCourseController;
use App\Http\Controllers\Admin\OnlineCourseUpdateController as AdminOnlineCourseUpdateController;
use App\Http\Controllers\Admin\WokiCourseController as AdminWokiCourseController;
use App\Http\Controllers\Admin\BootcampController as AdminBootcampController;
use App\Http\Controllers\Admin\BootcampFeatureController as AdminBootcampFeatureController;
use App\Http\Controllers\Admin\BootcampAboutController as AdminBootcampAboutController;
use App\Http\Controllers\Admin\BootcampUpdateController as AdminBootcampUpdateController;
use App\Http\Controllers\Admin\BootcampScheduleController as AdminBootcampScheduleController;
use App\Http\Controllers\Admin\BootcampBenefitController as AdminBootcampBenefitController;
use App\Http\Controllers\Admin\BootcampCandidateController as AdminBootcampCandidateController;
use App\Http\Controllers\Admin\BootcampFutureCareerController as AdminBootcampFutureCareerController;
use App\Http\Controllers\Admin\BootcampHiringPartnerController as AdminBootcampHiringPartnerController;
use App\Http\Controllers\Admin\BootcampBatchController as AdminBootcampBatchController;
use App\Http\Controllers\Admin\BootcampPricingContentController as AdminBootcampPricingContentController;
use App\Http\Controllers\Admin\ArtSupplyController as AdminArtSupplyController;
use App\Http\Controllers\Admin\WokiCourseUpdateController as AdminWokiCourseUpdateController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SectionContentController as AdminSectionContentController;
use App\Http\Controllers\Admin\CourseCategoryController as AdminCourseCategoryController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\AssessmentController as AdminAssessmentController;
use App\Http\Controllers\Admin\HashtagController as AdminHashtagController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\KrestController as AdminKrestController;
use App\Http\Controllers\Admin\KrestProgramController as AdminKrestProgramController;
use App\Http\Controllers\Admin\HiringPartnerController as AdminHiringPartnerController;
use App\Http\Controllers\Admin\CandidateController as AdminCandidateController;
use App\Http\Controllers\Admin\InstructorController as AdminInstructorController;
use App\Http\Controllers\Admin\InstructorPositionController as AdminInstructorPositionController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\RedeemController as AdminRedeemController;
use App\Http\Controllers\Admin\CollaboratorController as AdminCollaboratorController;
use App\Http\Controllers\Admin\ContactUsController as AdminContactUsController;

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
Route::middleware(['isSuspended'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Custom Auth Routes
    |
    | These are authentication-related routes outside of the already available
    | ones from laravel auth package.
    |--------------------------------------------------------------------------
    */
    Route::get('/signup', [CustomAuthController::class, 'signUpGeneralInfoIndex'])->name('custom-auth.signup_general_info.index')->middleware('guest');
    Route::post('/signup', [CustomAuthController::class, 'storeGeneralInfo'])->name('custom-auth.signup_general_info.store')->middleware('guest');
    Route::get('/signup-interests', [CustomAuthController::class, 'signUpInterestIndex'])->name('custom-auth.signup_interest.index')->middleware('guest');
    Route::post('/register', [CustomAuthController::class, 'storeNewUser'])->name('custom-auth.register')->middleware('guest');
    Route::post('/reset-password', [CustomAuthController::class, 'resetPassword'])->name('custom-auth.reset-password')->middleware('guest');
    Route::get('/job-portal/login', [CustomAuthController::class, 'showJobPortalLogin'])->name('job-portal.login')->middleware('guest');
    
    /* START OF CLIENT ROUTING */
    Route::get('/', [PagesController::class, 'index'])->name('index');
    Route::post('/search-course', [PagesController::class, 'search_course'])->name('search_course');
    Route::get('/autocomplete', [PagesController::class, 'autocomplete'])->name('autocomplete');
    Route::get('/community', [PagesController::class, 'community_index'])->name('customer_community');
    Route::get('/blog/{id}', [PagesController::class, 'blog_detail'])->name('blog_detail');
    Route::get('/blogs', [PagesController::class, 'blog_list'])->name('blog_list');

    /* DASHBOARD & USER RELATED ROUTES */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard')->middleware(['auth']);
    Route::put('/seeNotification', [PagesController::class, 'seeNotification'])->name('customer.seeNotification')->middleware(['auth']);
    Route::put('/update-profile/{id}', [DashboardController::class, 'update_profile'])->name('customer.update_profile')->middleware(['auth']);
    Route::put('/update-shipping/{id}', [DashboardController::class, 'update_shipping'])->name('customer.update_shipping')->middleware(['auth']);
    Route::post('/update-interest', [DashboardController::class, 'update_interest'])->name('customer.update_interest')->middleware(['auth']);
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('customer.change-password')->middleware(['auth', 'verified']);
    Route::get('/dashboard/redeem-vouchers', [DashboardController::class, 'redeem_index'])->name('customer.redeem_index')->middleware(['auth']);
    Route::post('/dashboard/redeem-vouchers', [DashboardController::class, 'redeemPromo'])->name('customer.redeemPromo')->middleware(['auth', 'verified']);
    Route::put('/bootcamp/upgrade-status', [DashboardController::class, 'upgradeBootcamp'])->name('bootcamp.upgrade-status')->middleware(['auth']);
    
    /* MENJADI PENGAJAR & KOLLABORATOR*/
    Route::post('/menjadi-pengajar', [AdminInstructorController::class, 'store'])->name('menjadi_pengajar.store');
    Route::post('/menjadi-kolaborator', [AdminCollaboratorController::class, 'store'])->name('collaborators.store');
    Route::post('/add-newsletter', [AdminNewsletterController::class, 'store'])->name('newsletter.store');

    /* CART ROUTING */
    Route::get('/transaction-detail/{id}', [CheckoutController::class, 'transactionDetail'])->name('customer.cart.transactionDetail')->middleware(['auth', 'verified']);
    Route::post('/cancelPayment/{id}', [CheckoutController::class, 'cancelPayment'])->name('customer.cart.cancelPayment')->middleware(['auth', 'verified']);
    Route::post('/receivePayment/{id}', [CheckoutController::class, 'receivePayment'])->name('customer.cart.receivePayment')->middleware(['auth', 'verified']);
    Route::post('/createPayment', [CheckoutController::class, 'store'])->name('customer.cart.storeOrder')->middleware(['auth', 'verified']);
    Route::post('/validate-voucher-code', [CheckoutController::class, 'validateVoucherCode'])->name('customer.cart.validate-voucher-code')->middleware(['auth', 'verified']);
    Route::get('/getBankStatus', [CartController::class, 'getBankStatus'])->name('customer.cart.getBankStatus')->middleware(['auth', 'verified']);
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart.index')->middleware(['auth']);
    Route::get('/payment', [CartController::class, 'shipment_index'])->name('customer.cart.shipment_index')->middleware(['auth']);
    Route::post('/cart', [CartController::class, 'store'])->name('customer.cart.store')->middleware(['auth']);
    Route::get('/cart/total', [CartController::class, 'getCartTotal'])->name('customer.cart.total')->middleware(['auth']);
    Route::post('/cart/remove/{id}', [CartController::class, 'removeCart'])->name('customer.cart.remove')->middleware(['auth']);
    Route::post('/cart/removeAll', [CartController::class, 'removeAllCart'])->name('customer.cart.removeAll')->middleware(['auth']);
    Route::post('/update-to-cart', [CartController::class, 'updatetocart'])->name('customer.updatetocart')->middleware(['auth']);
    Route::put('/increase-qty', [CartController::class, 'increaseQty'])->name('customer.increaseQty')->middleware(['auth']);
    Route::put('/decrease-qty', [CartController::class, 'decreaseQty'])->name('customer.decreaseQty')->middleware(['auth']);
    Route::get('/check-discount', [CartController::class, 'checkDiscount'])->name('customer.checkDiscount')->middleware(['auth', 'verified']);

    /* START OF ONLINE COURSE ROUTING */
    // OnlineCourseController
    Route::get('/online-course', [OnlineCourseController::class, 'index'])->name('online-course.index');
    Route::get('/online-course/{course_title}', [OnlineCourseController::class, 'show'])->name('online-course.show');
    Route::post('/online-course/{id}', [OnlineCourseController::class, 'buyFree'])->name('online-course.buyFree')->middleware(['auth', 'verified']);
    Route::get('/online-course/{course_id}/assessment', [AssessmentController::class, 'show'])->name('online-course-assesment.show')->middleware(['auth', 'verified']);
    Route::put('/online-course/assessment/{id}', [AssessmentController::class, 'updateAssessmentTimer'])->name('online-course-assesment.updateAssessmentTimer')->middleware(['auth', 'verified']);
    Route::get('online-course/{course_title}/learn/lecture/{content_title}', [OnlineCourseController::class, 'learn'])->name('online-course.learn')->middleware(['auth', 'verified']);
    // WokiController
    Route::get('/woki', [WokiController::class, 'index'])->name('woki.index');
    Route::get('/woki/{course_title}', [WokiController::class, 'show'])->name('woki.show');
    Route::post('/woki/{id}', [WokiController::class, 'buyFree'])->name('woki.buyFree')->middleware(['auth', 'verified']);
    // BootcampController
    Route::get('/bootcamp', [BootcampController::class, 'index'])->name('bootcamp.index');
    Route::get('/bootcamp/{id}', [BootcampController::class, 'show'])->name('bootcamp.show');
    Route::post('/bootcamp/{id}', [BootcampController::class, 'buyFree'])->name('bootcamp.buyFree')->middleware(['auth', 'verified']);
    Route::post('/bootcamp/{id}/full-registration', [BootcampController::class, 'storeFullRegistration'])->name('bootcamp.storeFullRegistration')->middleware(['auth']);
    Route::post('/bootcamp/{id}/syllabus', [BootcampController::class, 'sendSyllabus'])->name('bootcamp.sendSyllabus');
    // ReviewController
    Route::post('/addReview', [ReviewController::class, 'store'])->name('customer.review.store')->middleware(['auth', 'verified']);
    Route::delete('/deleteReview/{id}', [ReviewController::class, 'destroy'])->name('customer.review.destroy')->middleware(['auth', 'verified']);
    // AssessmentController
    Route::get('/online-course/{course_id}/assessment', [AssessmentController::class, 'show'])->name('online-course-assessment.show')->middleware(['auth', 'verified']);
    Route::get('/online-course/{course_id}/assessment/completed', [AssessmentController::class, 'completedIndex'])->name('online-course-assessment.completed-index')->middleware(['auth', 'verified']);
    Route::put('/online-course/assessment/{id}', [AssessmentController::class, 'update'])->name('online-course-assessment.update')->middleware(['auth', 'verified']);
    Route::put('/online-course/assessment/{id}/reset-user-assessment', [AssessmentController::class, 'resetUserAssessment'])->name('online-course-assessment.reset-user-assessment')->middleware(['auth', 'verified']);
    Route::put('/online-course/assessment/{id}/update-assessment-timer', [AssessmentController::class, 'updateAssessmentTimer'])->name('online-course-assessment.updateAssessmentTimer')->middleware(['auth', 'verified']);
    Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');
    /* END OF ONLINE COURSE ROUTING */

    /* START OF FOR PUBLIC ROUTING */
    Route::get('/for-public/online-course', [PagesController::class, 'online_course_index'])->name('customer.online_course_index');
    Route::get('/for-public/woki', [PagesController::class, 'woki_index'])->name('customer.woki_index');
    Route::get('/for-public/bootcamp', [PagesController::class, 'bootcamp_index'])->name('customer.bootcamp_index');
    Route::get('/pelatihan-venidici', [PagesController::class, 'pelatihan_venidici_index'])->name('customer.pelatihan_venidici_index');
    /* END OF FOR PUBLIC ROUTING*/
    
    /* START OF FOR CORPORATE ROUTING */
    Route::get('/for-corporate/krest', [KrestController::class, 'index'])->name('customer.krest_index');
    Route::post('/for-corporate/krest', [KrestController::class, 'store'])->name('customer.store_krest');
    /* END OF FOR CORPORATE ROUTING*/

    /* START OF CANDIDATE DETAILS ROUTING */
    Route::prefix('candidate-details')->name('candidate-detail.')->middleware(['auth', 'isCandidate'])->group(function() {
        Route::get('/', [CandidateDetailController::class, 'index'])->name('index');
        Route::post('/basic-info', [CandidateDetailController::class, 'upsertCandidateDetail'])->name('upsert-candidate-detail');
        Route::post('/work-experiences', [CandidateDetailController::class, 'storeWorkExperience'])->name('store-work-experience');
        Route::post('/educations', [CandidateDetailController::class, 'storeEducation'])->name('store-education');
        Route::post('/achievements', [CandidateDetailController::class, 'storeAchievement'])->name('store-achievement');
        Route::post('/hardskills', [CandidateDetailController::class, 'storeHardskill'])->name('store-hardskill');
        Route::post('/softskills', [CandidateDetailController::class, 'storeSoftskill'])->name('store-softskill');
        Route::post('/interests', [CandidateDetailController::class, 'storeInterest'])->name('store-interest');
    });
    /* END OF CANDIDATE DETAILS ROUTING */

    /* END OF CLIENT ROUTING */

    /*
    |--------------------------------------------------------------------------
    | Client Job Portal Routes
    |--------------------------------------------------------------------------
    | Description:
    | All routes in the group below has the /job-portal prefix, job-portal.* name
    | and uses ['auth', 'is_hiringPartner'] middleware.
    */
    Route::prefix('job-portal')->name('job-portal.')->middleware(['auth', 'isHiringPartner'])->group(function() {
        Route::get('/', [JobPortalController::class, 'index'])->middleware(['verified'])->name('index');
        Route::get('/profile', [JobPortalController::class, 'profileIndex'])->name('profile.index');
    });

    Route::get('/job-portal/1', [DashboardController::class, 'job_portal_candidate_detail'])->name('customer.job_portal_candidate_detail');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    | Description:
    | All routes in the group below has /admin prefix, admin.* name and uses
    | ['auth', 'isAdmin'] middleware (user must be logged in to access it).
    |
    | Controllers can be found inside -> App\Http\Controllers\Admin\
    */
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function() {
        // DashboardController
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
        // HomepageController
        Route::get('/cms/homepage', [AdminHomepageController::class, 'index'])->name('cms.homepage.index');
        Route::put('/cms/homepage/top-section', [AdminHomepageController::class, 'updateTopSection'])->name('cms.homepage.top-section.update');
        Route::post('/cms/homepage/trusted-company', [AdminHomepageController::class, 'storeTrustedCompanies'])->name('cms.homepage.trusted-company.store');
        Route::put('/cms/homepage/trusted-company', [AdminHomepageController::class, 'updateTrustedCompanies'])->name('cms.homepage.trusted-company.update');
        Route::get('/cms/homepage/testimonies/{id}/update/{flag}', [AdminHomepageController::class, 'editTestimonies'])->name('cms.homepage.testimonies.edit');
        Route::put('/cms/homepage/testimonies/{id}', [AdminHomepageController::class, 'updateTestimonies'])->name('cms.homepage.testimonies.update');
        Route::post('/cms/homepage/trusted-company/delete', [AdminHomepageController::class, 'destroyTrustedCompany'])->name('cms.homepage.trusted-company.destroy');
        // AnalyticsController
        Route::get('/analytics/online-course', [AdminAnalyticsController::class, 'onlineCourseIndex'])->name('analytics.online-course.index');
        Route::get('/analytics/woki-course', [AdminAnalyticsController::class, 'wokiCourseIndex'])->name('analytics.woki-course.index');
        // UserController
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::put('/users', [AdminUserController::class, 'add_stars'])->name('users.add_stars');
        Route::post('/users/{id}/set-status-to-opposite', [AdminUserController::class, 'setStatusToOpposite'])->name('users.set-status-to-opposite');
        Route::post('/users/{id}/set-role-to-opposite', [AdminUserController::class, 'setRoleToOpposite'])->name('users.set-role-to-opposite');
        // InvoiceController
        Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{id}', [AdminInvoiceController::class, 'show'])->name('invoices.show');
        Route::post('/invoices/refresh', [AdminInvoiceController::class, 'refresh'])->name('invoices.refresh');
        Route::delete('/invoices/{id}', [AdminInvoiceController::class, 'destroy'])->name('invoices.destroy')->middleware(['isSuper']);
        Route::post('/invoices/export', [AdminInvoiceController::class, 'export'])->name('invoices.export');
        // OnlineCourseController
        Route::get('/online-courses', [AdminOnlineCourseController::class, 'index'])->name('online-courses.index');
        Route::get('/online-courses/create', [AdminOnlineCourseController::class, 'create'])->name('online-courses.create');
        Route::get('/online-courses/{id}', [AdminOnlineCourseController::class, 'show'])->name('online-courses.show');
        Route::post('/online-courses', [AdminOnlineCourseController::class, 'store'])->name('online-courses.store');
        Route::put('/online-course/{id}/archive', [AdminOnlineCourseController::class, 'archive'])->name('online-courses.archive');
        Route::put('/online-course/{id}/un-archive', [AdminOnlineCourseController::class, 'unArchive'])->name('online-courses.unArchive');
        Route::post('/online-courses/{id}/set-isfeatured-status-to-opposite', [AdminOnlineCourseController::class, 'setIsFeaturedStatusToOpposite'])->name('online-courses.set-isfeatured-status-to-opposite');
        Route::post('/online-courses/{id}/set-publish-status-to-opposite', [AdminOnlineCourseController::class, 'setPublishStatusToOpposite'])->name('online-courses.set-publish-status-to-opposite');
        // OnlineCourseUpdateController
        Route::get('/online-courses/{id}/update', [AdminOnlineCourseUpdateController::class, 'edit'])->name('online-courses.edit');
        Route::put('/online-courses/{id}/update-basic-info', [AdminOnlineCourseUpdateController::class, 'updateBasicInfo'])->name('online-courses.update-basic-info');
        Route::put('/online-courses/{id}/update-pricing-enrollment', [AdminOnlineCourseUpdateController::class, 'updatePricingEnrollment'])->name('online-courses.update-pricing-enrollment');
        Route::put('/online-courses/{id}/update-publish-status', [AdminOnlineCourseUpdateController::class, 'updatePublishStatus'])->name('online-courses.update-publish-status');
        Route::put('/online-courses/{id}/attach-teacher', [AdminOnlineCourseUpdateController::class, 'attachTeacher'])->name('online-courses.attach-teacher');
        Route::put('/online-courses/{id}/detach-teacher', [AdminOnlineCourseUpdateController::class, 'detachTeacher'])->name('online-courses.detach-teacher');
        // ArtSupplyController
        Route::get('/woki-courses/art-supplies', [AdminArtSupplyController::class, 'index'])->name('art-supplies.index');
        Route::get('/woki-courses/art-supplies/create', [AdminArtSupplyController::class, 'create'])->name('art-supplies.create');
        Route::post('/woki-courses/art-supplies', [AdminArtSupplyController::class, 'store'])->name('art-supplies.store');
        Route::get('/woki-courses/art-supplies/{id}/update', [AdminArtSupplyController::class, 'edit'])->name('art-supplies.edit');
        Route::put('/woki-courses/art-supplies/{id}', [AdminArtSupplyController::class, 'update'])->name('art-supplies.update');
        Route::delete('/woki-courses/art-supplies/{id}', [AdminArtSupplyController::class, 'destroy'])->name('art-supplies.destroy');
        // WokiCourseController
        Route::get('/woki-courses', [AdminWokiCourseController::class, 'index'])->name('woki-courses.index');
        Route::get('/woki-courses/create', [AdminWokiCourseController::class, 'create'])->name('woki-courses.create');
        Route::get('/woki-courses/{id}', [AdminWokiCourseController::class, 'show'])->name('woki-courses.show');
        Route::post('/woki-courses/{id}/set-isabsent-status-to-opposite', [AdminWokiCourseController::class, 'setIsAbsentStatusToOpposite'])->name('woki-courses.set-isabsent-status-to-opposite');
        Route::post('/woki-courses', [AdminWokiCourseController::class, 'store'])->name('woki-courses.store');
        Route::delete('/woki-courses/{id}', [AdminWokiCourseController::class, 'destroy'])->name('woki-courses.destroy');
        Route::put('/woki-course/{id}/archive', [AdminWokiCourseController::class, 'archive'])->name('woki-courses.archive');
        Route::put('/woki-course/{id}/un-archive', [AdminWokiCourseController::class, 'unArchive'])->name('woki-courses.unArchive');
        Route::post('/woki-courses/{id}/set-isfeatured-status-to-opposite', [AdminWokiCourseController::class, 'setIsFeaturedStatusToOpposite'])->name('woki-courses.set-isfeatured-status-to-opposite');
        Route::post('/woki-courses/{id}/set-publish-status-to-opposite', [AdminWokiCourseController::class, 'setPublishStatusToOpposite'])->name('woki-courses.set-publish-status-to-opposite');
        Route::put('/woki-courses/{id}/set-as-done', [AdminWokiCourseController::class, 'setWokiAsDone'])->name('woki-courses.set-as-done');
        // WokiCourseUpdateController
        Route::get('/woki-courses/{id}/update', [AdminWokiCourseUpdateController::class, 'edit'])->name('woki-courses.edit');
        Route::put('/woki-courses/{id}/update-basic-info', [AdminWokiCourseUpdateController::class, 'updateBasicInfo'])->name('woki-courses.update-basic-info');
        Route::put('/woki-courses/{id}/update-pricing-enrollment', [AdminWokiCourseUpdateController::class, 'updatePricingEnrollment'])->name('woki-courses.update-pricing-enrollment');
        Route::put('/woki-courses/{id}/update-publish-status', [AdminWokiCourseUpdateController::class, 'updatePublishStatus'])->name('woki-courses.update-publish-status');
        Route::put('/woki-courses/{id}/attach-detach-art-supply', [AdminWokiCourseUpdateController::class, 'attachDetachArtSupply'])->name('woki-courses.attach-detach-art-supply');
        Route::put('/woki-courses/{id}/attach-teacher', [AdminWokiCourseUpdateController::class, 'attachTeacher'])->name('woki-courses.attach-teacher');
        Route::put('/woki-courses/{id}/detach-teacher', [AdminWokiCourseUpdateController::class, 'detachTeacher'])->name('woki-courses.detach-teacher');
        // BootcampController
        Route::get('/bootcamp/categories', [AdminBootcampController::class, 'categories'])->name('bootcamp.categories');
        Route::get('/bootcamp', [AdminBootcampController::class, 'index'])->name('bootcamp.index');
        Route::get('/bootcamp/create', [AdminBootcampController::class, 'create'])->name('bootcamp.create');
        Route::get('/bootcamp/{id}', [AdminBootcampController::class, 'show'])->name('bootcamp.show');
        Route::get('/bootcamp/{id}/syllabus-requests', [AdminBootcampController::class, 'syllabusRequests'])->name('bootcamp.syllabusRequests');
        Route::post('/bootcamp', [AdminBootcampController::class, 'store'])->name('bootcamp.store');
        Route::put('/bootcamp/{id}/archive', [AdminBootcampController::class, 'archive'])->name('bootcamp.archive');
        Route::put('/bootcamp/{id}/un-archive', [AdminBootcampController::class, 'unArchive'])->name('bootcamp.unArchive');
        Route::post('/bootcamp/{id}/set-isfeatured-status-to-opposite', [AdminBootcampController::class, 'setIsFeaturedStatusToOpposite'])->name('bootcamp.set-isfeatured-status-to-opposite');
        Route::post('/bootcamp/{id}/set-publish-status-to-opposite', [AdminBootcampController::class, 'setPublishStatusToOpposite'])->name('bootcamp.set-publish-status-to-opposite');
        Route::delete('/bootcamp/{id}/remove-syllabus', [AdminBootcampController::class, 'removeSyllabus'])->name('bootcamp.remove-syllabus');
        Route::put('/bootcamp/{id}/change_application_status', [AdminBootcampController::class, 'changeApplicationStatus'])->name('bootcamp.change-application-status');
        // BootcampFeatureController
        Route::post('/bootcamp/{id}/store-feature', [AdminBootcampFeatureController::class, 'store'])->name('bootcamp-feature.store');
        Route::delete('/bootcamp-feature/{id}', [AdminBootcampFeatureController::class, 'destroy'])->name('bootcamp-feature.destroy');
        Route::put('/bootcamp-feature/update', [AdminBootcampFeatureController::class, 'update'])->name('bootcamp-feature.update');
        // BootcampPricingContentController
        Route::post('/bootcamp-full-payment-content/update/{id}', [AdminBootcampPricingContentController::class, 'updateFullPayment'])->name('bootcamp-full-payment-content.update');
        Route::post('/bootcamp-income-share-agreement-content-content/update/{id}', [AdminBootcampPricingContentController::class, 'updateIncomeShareAgreement'])->name('bootcamp-income-share-agreement-content.update');
        // BootcampAboutController
        Route::post('/bootcamp/{id}/store-about', [AdminBootcampAboutController::class, 'store'])->name('bootcamp-about.store');
        Route::get('/bootcamp-about/{id}/update', [AdminBootcampAboutController::class, 'edit'])->name('bootcamp.about-edit');
        Route::put('/bootcamp-about/{id}/update', [AdminBootcampAboutController::class, 'update'])->name('bootcamp-about.update');
        Route::delete('/bootcamp-about/{id}', [AdminBootcampAboutController::class, 'destroy'])->name('bootcamp-about.destroy');
        // BootcampUpdateController
        Route::get('/bootcamp/{id}/update', [AdminBootcampUpdateController::class, 'edit'])->name('bootcamp.edit');
        Route::put('/bootcamp/{id}/update-basic-info', [AdminBootcampUpdateController::class, 'updateBasicInfo'])->name('bootcamp.update-basic-info');
        Route::put('/bootcamp/{id}/update-pricing-enrollment', [AdminBootcampUpdateController::class, 'updatePricingEnrollment'])->name('bootcamp.update-pricing-enrollment');
        Route::put('/bootcamp/{id}/update-publish-status', [AdminBootcampUpdateController::class, 'updatePublishStatus'])->name('bootcamp.update-publish-status');
        Route::put('/bootcamp/{id}/attach-teacher', [AdminBootcampUpdateController::class, 'attachTeacher'])->name('bootcamp.attach-teacher');
        Route::put('/bootcamp/{id}/detach-teacher', [AdminBootcampUpdateController::class, 'detachTeacher'])->name('bootcamp.detach-teacher');
        Route::get('/bootcamp-schedules/{id}/update', [AdminBootcampUpdateController::class, 'editBootcampSchedules'])->name('bootcamp.edit-schedules');
        // BootcampScheduleController
        // Route::get('/bootcampschedule', [AdminBootcampScheduleController::class, 'index'])->name('bootcampschedule.index');
        // Route::get('/bootcampschedule/create', [AdminBootcampScheduleController::class, 'create'])->name('bootcampschedule.create');
        Route::post('/bootcampschedule/{id}/store', [AdminBootcampScheduleController::class, 'store'])->name('bootcampschedule.store');
        Route::get('/bootcampschedule/{id}/update', [AdminBootcampScheduleController::class, 'edit'])->name('bootcampschedule.edit');
        Route::put('/bootcampschedule/{id}', [AdminBootcampScheduleController::class, 'update'])->name('bootcampschedule.update');
        Route::delete('/bootcampschedule/{id}', [AdminBootcampScheduleController::class, 'destroy'])->name('bootcampschedule.destroy');
        // BootcampBenefitController
        Route::post('/bootcamp/{id}/store-benefit', [AdminBootcampBenefitController::class, 'store'])->name('bootcamp-benefit.store');
        Route::get('/bootcamp-benefit/{id}/update', [AdminBootcampBenefitController::class, 'edit'])->name('bootcamp.benefit-edit');
        Route::put('/bootcamp-benefit/{id}/update', [AdminBootcampBenefitController::class, 'update'])->name('bootcamp-benefit.update');
        Route::delete('/bootcamp-benefit/{id}', [AdminBootcampBenefitController::class, 'destroy'])->name('bootcamp-benefit.destroy'); 
        // BootcampFutureCareerController
        Route::post('/bootcamp/{id}/store-future-career', [AdminBootcampFutureCareerController::class, 'store'])->name('bootcamp-future-career.store');
        Route::get('/bootcamp-future-career/{id}/update', [AdminBootcampFutureCareerController::class, 'edit'])->name('bootcamp.future-career-edit');
        Route::put('/bootcamp-future-career/{id}/update', [AdminBootcampFutureCareerController::class, 'update'])->name('bootcamp-future-career.update');
        Route::delete('/bootcamp-future-career/{id}', [AdminBootcampFutureCareerController::class, 'destroy'])->name('bootcamp-future-career.destroy'); 
        // BootcampCandidateController
        Route::post('/bootcamp/{id}/store-candidate', [AdminBootcampCandidateController::class, 'store'])->name('bootcamp-candidate.store');
        Route::get('/bootcamp-candidate/{id}/update', [AdminBootcampCandidateController::class, 'edit'])->name('bootcamp.candidate-edit');
        Route::put('/bootcamp-candidate/{id}/update', [AdminBootcampCandidateController::class, 'update'])->name('bootcamp-candidate.update');
        Route::delete('/bootcamp-candidate/{id}', [AdminBootcampCandidateController::class, 'destroy'])->name('bootcamp-candidate.destroy');
        // BootcampHiringPartnerController
        Route::post('/bootcamp/{id}/store-hiring-partner', [AdminBootcampHiringPartnerController::class, 'store'])->name('bootcamp-hiring-partner.store');
        Route::get('/bootcamp-hiring-partner/{id}/update', [AdminBootcampHiringPartnerController::class, 'edit'])->name('bootcamp.hiring-partner-edit');
        Route::put('/bootcamp-hiring-partner/{id}/update', [AdminBootcampHiringPartnerController::class, 'update'])->name('bootcamp-hiring-partner.update');
        Route::delete('/bootcamp-hiring-partner/{id}', [AdminBootcampHiringPartnerController::class, 'destroy'])->name('bootcamp-hiring-partner.destroy');
        // BootcampBatchController
        Route::post('/bootcamp/{id}/store-batch', [AdminBootcampBatchController::class, 'store'])->name('bootcamp-batch.store');
        Route::get('/bootcamp-batch/{id}/update', [AdminBootcampBatchController::class, 'edit'])->name('bootcamp.batch-edit');
        Route::put('/bootcamp-batch/{id}/update', [AdminBootcampBatchController::class, 'update'])->name('bootcamp-batch.update');
        Route::delete('/bootcamp-batch/{id}', [AdminBootcampBatchController::class, 'destroy'])->name('bootcamp-batch.destroy');
        // SectionController
        Route::post('/sections', [AdminSectionController::class, 'store'])->name('sections.store');
        Route::put('/sections/{id}', [AdminSectionController::class, 'update'])->name('sections.update');
        Route::delete('sections/{id}', [AdminSectionController::class, 'destroy'])->name('sections.destroy');
        // SectionSegmentController
        Route::post('/section-contents', [AdminSectionContentController::class, 'store'])->name('section-contents.store');
        Route::get('/section-contents/{id}/update', [AdminSectionContentController::class, 'edit'])->name('section-contents.edit');
        Route::put('/section-contents/{id}', [AdminSectionContentController::class, 'update'])->name('section-contents.update');
        Route::delete('/section-contents/{id}', [AdminSectionContentController::class, 'destroy'])->name('section-contents.destroy');
        Route::delete('/section-contents/{id}/remove-attachment', [AdminSectionContentController::class, 'removeAttachment'])->name('section-contents.remove-attachment');
        // CourseCategoryController
        Route::get('/course-categories', [AdminCourseCategoryController::class, 'index'])->name('course-categories.index');
        Route::post('/course-categories', [AdminCourseCategoryController::class, 'store'])->name('course-categories.store');
        Route::put('/course-categories/{id}', [AdminCourseCategoryController::class, 'update'])->name('course-categories.update');
        Route::delete('/course-categories/{id}', [AdminCourseCategoryController::class, 'destroy'])->name('course-categories.destroy');
        // TeacherController
        Route::get('/teachers', [AdminTeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/create', [AdminTeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers', [AdminTeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/update', [AdminTeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [AdminTeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [AdminTeacherController::class, 'destroy'])->name('teachers.destroy');
        // AssestmentController
        Route::get('/assessments/{assessment_id}/result/{user_id}', [AdminAssessmentController::class, 'showResult'])->name('assessments.showResult');
        Route::get('/assessments', [AdminAssessmentController::class, 'index'])->name('assessments.index');
        Route::get('/assessments/create', [AdminAssessmentController::class, 'create'])->name('assessments.create');
        Route::post('/assessments', [AdminAssessmentController::class, 'store'])->name('assessments.store');
        Route::post('/assessments/{id}/questions', [AdminAssessmentController::class, 'storeQuestion'])->name('assessments.store-question');
        Route::get('/assessments/{id}/update', [AdminAssessmentController::class, 'edit'])->name('assessments.edit');
        Route::put('/assessments/{id}', [AdminAssessmentController::class, 'updateBasicInfo'])->name('assessments.update-basic-info');
        Route::put('/assessments/{assessment_id}/questions/{question_id}', [AdminAssessmentController::class, 'updateQuestion'])->name('assessments.update-question');
        Route::delete('/assessments/{id}', [AdminAssessmentController::class, 'destroy'])->name('assessments.destroy');
        Route::delete('/assessments/{assessment_id}/questions/{question_id}', [AdminAssessmentController::class, 'destroyQuestion'])->name('assessments.destroy-question');
        // KrestController
        Route::get('/krest/applicants', [AdminKrestController::class, 'index'])->name('krest.index');
        Route::put('/krest/applicants/{id}', [AdminKrestController::class, 'updateStatus'])->name('krest.updateStatus');
        // KrestProgramsController
        Route::get('/krest/programs', [AdminKrestProgramController::class, 'index'])->name('krest_programs.index');
        Route::get('/krest/programs/create', [AdminKrestProgramController::class, 'create'])->name('krest_programs.create');
        Route::post('/krest/programs', [AdminKrestProgramController::class, 'store'])->name('krest_programs.store');
        Route::get('/krest/programs/{id}/update', [AdminKrestProgramController::class, 'edit'])->name('krest_programs.edit');
        Route::put('/krest/programs/{id}', [AdminKrestProgramController::class, 'update'])->name('krest_programs.update');
        Route::delete('/krest/programs/{id}', [AdminKrestProgramController::class, 'destroy'])->name('krest_programs.destroy');
        // HiringPartnerController
        Route::get('/job-portal/hiring-partners', [AdminHiringPartnerController::class, 'index'])->name('job-portal.hiring-partners.index');
        Route::get('/job-portal/hiring-partners/create', [AdminHiringPartnerController::class, 'create'])->name('job-portal.hiring-partners.create');
        Route::post('/job-portal/hiring-partners', [AdminHiringPartnerController::class, 'store'])->name('job-portal.hiring-partners.store');
        Route::delete('/job-portal/hiring-partners/{id}', [AdminHiringPartnerController::class, 'destroy'])->name('job-portal.hiring-partners.destroy')->middleware(['isSuper']);
        // CandidateController
        Route::get('/job-portal/candidates', [AdminCandidateController::class, 'index'])->name('job-portal.candidates.index');
        Route::get('/job-portal/{candidate_id}', [AdminCandidateController::class, 'showCandidate'])->name('job-portal.candidates.showCandidate');
        Route::get('/job-portal/{candidate_detail_id}/changes', [AdminCandidateController::class, 'showCandidateChange'])->name('job-portal.candidates.showCandidateChange');
        Route::post('/job-portal/approve-change', [AdminCandidateController::class, 'approveChange'])->name('job-portal.candidates.approve-change');
        // HashtagController
        Route::get('/hashtags', [AdminHashtagController::class, 'index'])->name('hashtags.index');
        Route::get('/hashtags/create', [AdminHashtagController::class, 'create'])->name('hashtags.create');
        Route::post('/hashtags', [AdminHashtagController::class, 'store'])->name('hashtags.store');
        Route::get('/hashtags/{id}/update', [AdminHashtagController::class, 'edit'])->name('hashtags.edit');
        Route::put('/hashtags/{id}', [AdminHashtagController::class, 'update'])->name('hashtags.update');
        Route::delete('/hashtags/{id}', [AdminHashtagController::class, 'destroy'])->name('hashtags.destroy');
        // PromotionController
        Route::get('/promotions', [AdminPromotionController::class, 'index'])->name('promotions.index');
        Route::get('/promotions/create', [AdminPromotionController::class, 'create'])->name('promotions.create');
        Route::post('/promotions', [AdminPromotionController::class, 'store'])->name('promotions.store');
        Route::get('/promotions/{id}/update', [AdminPromotionController::class, 'edit'])->name('promotions.edit');
        Route::put('/promotions/{id}', [AdminPromotionController::class, 'update'])->name('promotions.update');
        Route::delete('/promotions/{id}', [AdminPromotionController::class, 'destroy'])->name('promotions.destroy');
        //ReviewController
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
        // NotificationController
        Route::get('/informations', [AdminNotificationController::class, 'index'])->name('informations.index');
        Route::get('/informations/create', [AdminNotificationController::class, 'create'])->name('informations.create');
        Route::post('/informations', [AdminNotificationController::class, 'store'])->name('informations.store');
        Route::get('/informations/{id}/update', [AdminNotificationController::class, 'edit'])->name('informations.edit');
        Route::put('/informations/{id}', [AdminNotificationController::class, 'update'])->name('informations.update');
        Route::delete('/informations/{id}', [AdminNotificationController::class, 'destroy'])->name('informations.destroy');
        // BlogController
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [AdminBlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/update', [AdminBlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
        Route::post('/blog/{id}/set-isfeatured-status-to-opposite', [AdminBlogController::class, 'setIsFeaturedStatusToOpposite'])->name('blog.set-isfeatured-status-to-opposite');
        // InstructorController
        Route::get('/menjadi-pengajar', [AdminInstructorController::class, 'index'])->name('instructors.index');
        Route::delete('/menjadi-pengajar/{id}', [AdminInstructorController::class, 'destroy'])->name('instructors.destroy');
        // PromotionController
        Route::get('/menjadi-pengajar/positions', [AdminInstructorPositionController::class, 'index'])->name('instructor-positions.index');
        Route::get('/menjadi-pengajar/positions/create', [AdminInstructorPositionController::class, 'create'])->name('instructor-positions.create');
        Route::post('/menjadi-pengajar/positions', [AdminInstructorPositionController::class, 'store'])->name('instructor-positions.store');
        Route::get('/menjadi-pengajar/positions/{id}/update', [AdminInstructorPositionController::class, 'edit'])->name('instructor-positions.edit');
        Route::put('/menjadi-pengajar/positions/{id}', [AdminInstructorPositionController::class, 'update'])->name('instructor-positions.update');
        Route::delete('/menjadi-pengajar/positions/{id}', [AdminInstructorPositionController::class, 'destroy'])->name('instructor-positions.destroy');
        Route::put('/menjadi-pengajar/positions/{id}/updateStatus', [AdminInstructorPositionController::class, 'updateStatus'])->name('instructor-positions.updateStatus');
        //NewsletterController
        Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
        Route::delete('/newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');
        //ContactUsController
        Route::get('/contact-us', [AdminContactUsController::class, 'index'])->name('contact-us.index');
        Route::delete('/contact-us/{id}', [AdminContactUsController::class, 'destroy'])->name('contact-us.destroy');
        // RedeemController
        Route::get('/redeems', [AdminRedeemController::class, 'index'])->name('redeems.index');
        Route::get('/redeems/create', [AdminRedeemController::class, 'create'])->name('redeems.create');
        Route::post('/redeems', [AdminRedeemController::class, 'store'])->name('redeems.store');
        Route::get('/redeems/{id}/update', [AdminRedeemController::class, 'edit'])->name('redeems.edit');
        Route::put('/redeems/{id}', [AdminRedeemController::class, 'update'])->name('redeems.update');
        Route::delete('/redeems/{id}', [AdminRedeemController::class, 'destroy'])->name('redeems.destroy');
        //CollaboratorController
        Route::get('/menjadi-kolaborator', [AdminCollaboratorController::class, 'index'])->name('collaborators.index');
        Route::delete('/menjadi-kolaborator/{id}', [AdminCollaboratorController::class, 'destroy'])->name('collaborators.destroy');
        //CollaboratorController
        Route::get('/donations', [AdminPromotionController::class, 'donations_index'])->name('donations.index');
    });
    /* END OF ADMIN ROUTING */

    /* START OF GOOGLE AUTH */
    Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback']);
    /* END OF GOOGLE AUTH*/

    // ROUTES TO CHECK EMAIL VIEWS
    if (!App::environment('production')) {
        Route::get('/email/verifyUser', function () {
            return view('emails/verifyUser');
        });
        Route::get('/email/checkout', function () {
            return view('emails/checkout');
        });
        Route::get('/email/invoice', function () {
            return view('emails/invoice');
        });
        Route::get('/email/complete_course', function () {
            return view('emails/complete_course');
        });
        Route::get('/email/forget_password', function () {
            return view('emails/forget_password');
        });
        Route::get('/email/password_changed', function () {
            return view('emails/passwordChanged');
        });
        Route::get('/email/live_pelatihan', function () {
            return view('emails/live_pelatihan');
        });
        Route::get('/email/suspend', function () {
            return view('emails/suspend');
        });
        Route::get('/certificate', function () {
            return view('client/certificate');
        });
        Route::get('/level_up', function () {
            return view('emails/level_up');
        });
        Route::get('/emails/bootcamp/full_registration', function () {
            return view('emails/bootcamp_full_registration');
        });
        Route::get('/admin/job-portal/hiring-partners/1/candidates', function () {
            return view('admin/job-portal/contacted-candidates');
        });
    };

    /* OTHERS ROUTING */
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::post('/certificate/pdf', [PagesController::class, 'print'])->name('print_certificate')->middleware(['auth', 'verified']);
    /* OTHERS ROUTING */
});

require __DIR__.'/auth.php';
