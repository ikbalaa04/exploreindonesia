<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\newsController;
use App\Http\Controllers\web\homeController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\cms\aboutUsController;
use App\Http\Controllers\cms\bannersController;
use App\Http\Controllers\web\messageController;
use App\Http\Controllers\cms\bookmarkController;
use App\Http\Controllers\cms\packagesController;
use App\Http\Controllers\cms\partnersController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\cms\dashboardController;
use App\Http\Controllers\cms\subscribeController;
use App\Http\Controllers\cms\categoriesController;
use App\Http\Controllers\cms\achievementController;
use App\Http\Controllers\cms\fileManagerController;
use App\Http\Controllers\cms\officeHoursController;
use App\Http\Controllers\cms\testimoniesController;
use App\Http\Controllers\web\tourPlanningController;
use App\Http\Controllers\cms\subCategoriesController;
use App\Http\Controllers\web\dashboardUserController;
use App\Http\Controllers\cms\companyMembersController;
use App\Http\Controllers\cms\userManagementController;
use App\Http\Controllers\Auth\forgotPasswordController;

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

// login 
Route::get('/login', [loginController::class, 'getlogin'])->name('login');
Route::get('/notlogin', [loginController::class, 'notlogin'])->name('notlogin');
Route::post('/logins',[loginController::class, 'login'])->name('admin.login');
// forgot password 
Route::get('/forgot-password', [forgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgots-passwords', [forgotPasswordController::class, 'postForgotPassword'])->name('postForgotPassword');
Route::get('/reset-password/{otp}/{email}', [forgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-passwords/{otp}/{email}', [forgotPasswordController::class, 'postResetPassword'])->name('postResetPassword');
// register 
Route::get('/register', [registerController::class, 'getregister'])->name('register');
Route::post('/register', [registerController::class, 'register'])->name('admin.register');
Route::get('/join/{code}/{email}',[registerController::class, 'join'])->name('admin.join');
// google 
Route::get('/auth/redirect', [loginController::class, 'redirectProvider'])->name('provider.redirect');
Route::get('/auth/callback', [loginController::class, 'providerCallback'])->name('provider.callback');
// home 
Route::get('/', [homeController::class, 'home'])->name('web.home');
Route::get('/trip-finder', [homeController::class, 'tripFinder'])->name('web.tripFinder');
Route::get('/about', [homeController::class, 'about'])->name('web.about');
Route::get('/destination', [homeController::class, 'destination'])->name('web.destination');
Route::get('/excursion/detail/{slug}', [homeController::class, 'excursion'])->name('web.excursion');
Route::get('/kalimantan/index', [homeController::class, 'kalimantan'])->name('web.kalimantan');
Route::get('/tour-planning', [homeController::class, 'tourPlanning'])->name('web.tourPlanning');
Route::get('/filter/trip', [homeController::class, 'filterTrip'])->name('web.filterTrip');
Route::get('/profile/partner', [homeController::class, 'profilePartner'])->name('web.profilePartner');
// tour planning 
Route::post('/tour-planning/create', [tourPlanningController::class, 'create'])->name('tourPlanning.create');
Route::get('/tour-planning/index', [tourPlanningController::class, 'index'])->name('tourPlanning.index');
// dashboard user 
Route::get('/dashboard/user/wishlist', [dashboardUserController::class,'wishlist'])->name('dashboard.user.wishlist');
Route::get('/dashboard/user/chat', [dashboardUserController::class,'chat'])->name('dashboard.user.chat');
Route::get('/dashboard/user/profile', [dashboardUserController::class,'profile'])->name('dashboard.user.profile');
// blog 
Route::get('detail/blog/{slug}', [homeController::class, 'detailBlog'])->name('web.detailBlog');
// subsribe 
Route::post('subscribe/subscribeEmail/', [subscribeController::class, 'subscribeEmail'])->name('subscribe.subscribeEmail');
// auth 
Route::group(['middleware' => ['auth:web']], function() {
    // messsage 
    Route::get('message', [messageController::class,'index'])->name('message.index');
    Route::get('message/refresh', [messageController::class,'refresh'])->name('message.refresh');
    Route::post('message/send', [messageController::class,'send'])->name('message.send');
    // bookmark 
    Route::post('bookmark/store', [bookmarkController::class,'store'])->name('bookmark.store');
    Route::delete('bookmark/destroy', [bookmarkController::class,'destroy'])->name('bookmark.destroy');
    // subscribe 
    Route::post('subscribe/unscribe/{id}', [subscribeController::class, 'unscribe'])->name('subscribe.unscribe');
    Route::post('subscribe/subscribe/{id}', [subscribeController::class, 'subscribe'])->name('subscribe.subscribe');
    Route::post('sendEmail', [subscribeController::class, 'sendEmail'])->name('subscribe.sendEmail');
    // logout 
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');
    // dashboard 
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('cms.dashboard');
    // news management 
    Route::group(['prefix' => 'news-management', 'as' => 'newsManagement.'], function() {
        Route::resource('news', newsController::class)->except(['show']);
    });
    // website management 
    Route::group(['prefix' => 'website-management', 'as' => 'websiteManagement.'], function() {
        // banner 
        Route::resource('banner', bannersController::class)->except('show');
        // partner 
        Route::resource('partner', partnersController::class)->except('show');
        // testimony 
        Route::resource('testimony', testimoniesController::class)->except('show');
    });
    // file manager 
    Route::group(['prefix' => 'file-manager', 'as' => 'fileManager.'], function() {
        // file 
        Route::resource('file', fileManagerController::class);
    });
    // company management 
    Route::group(['prefix' => 'company-management', 'as' => 'companyManagement.'], function() {
        // about us 
        Route::resource('about-us', aboutUsController::class)->except(['show','index','edit']);
        Route::resource('office-hours',officeHoursController::class)->except(['index','show','create','edit']);
        Route::resource('achievement',achievementController::class)->except(['create','edit']);
        Route::resource('company-members',companyMembersController::class)->except(['create','edit']);
    });
    // management master data 
    Route::group(['prefix' => 'master-data', 'as' => 'masterData.'], function(){
        // category 
        Route::resource('category', categoriesController::class)->except('show');
        // sub category 
        Route::resource('sub-category', subCategoriesController::class)->except('show');
        // packages 
        Route::resource('packages', packagesController::class)->except('show');
        Route::post('packages/upload', [packagesController::class, 'uploadImage'])->name('packages.uploadImage');
        Route::post('packages/upload/icon', [packagesController::class, 'uploadIcon'])->name('packages.uploadIcon');
    });
    // user count 
    Route::get('userManagement/count',[userManagementController::class,'userCount'])->name('userCount');
    //userManagement
    Route::resource('userManagement', userManagementController::class)->except(['show']);
    Route::post('userManagement/active/{id}', [userManagementController::class, 'active'])->name('userManagement.active');
    Route::get('userManagement/customer',[userManagementController::class,'customer'])->name('dashboard.customer');
    Route::get('profile/{id}',[userManagementController::class,'profile'])->name('dashboard.profile');
    
});