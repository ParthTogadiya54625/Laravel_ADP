<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BusinessController as AdminBusinessController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DbImportExportController;
use App\Http\Controllers\Admin\HeadingContoller;
use App\Http\Controllers\Admin\KeywordContoller;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\RolePermissionsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\BusinessController;
use App\Http\Controllers\Frontend\PDFController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('reset_password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {

    Route::group(['as'=>'auth.', 'middleware'=>'alreadyLoggedIn'], function () {
        Route::get('/',                 [AuthController::class, 'loginForm'])->name('loginForm');
        Route::post('login',            [AuthController::class, 'loginFormSubmit'])->name('loginFormSubmit');
        Route::get('forgot_password',   [AuthController::class, 'forgotePasswordForm'])->name('forgotPasswordForm');
        Route::post('forgot_password',  [AuthController::class, 'forgotePasswordFormSubmit'])->name('forgotPasswordFormSubmit');
        Route::post('reset_password',   [AuthController::class, 'resetPasswordFormSubmit'])->name('resetPasswordFormSubmit');
    });

    Route::group(['as'=>'auth.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('dashboard',         [DashboardController::class, 'index'])->name('dashboard');
        Route::get('change_password',   [AuthController::class, 'changePasswordForm'])->name('changePasswordForm');
        Route::post('change_password',  [AuthController::class, 'changePasswordFormSubmit'])->name('changePasswordFormSubmit');
        Route::get('change_profile',    [AuthController::class, 'changeProfile'])->name('changeProfile');
        Route::post('change_profile',   [AuthController::class, 'userProfileFormSubmit'])->name('userProfileFormSubmit');
        Route::get('logout',            [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix'=>'role', 'as'=>'role.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('index',      [RolePermissionsController::class, 'index'])->name('index');
        Route::get('create',     [RolePermissionsController::class, 'create'])->name('create');
        Route::post('store',     [RolePermissionsController::class, 'store'])->name('store');
        Route::get('edit/{id}',  [RolePermissionsController::class, 'edit'])->name('edit');
        Route::post('update',    [RolePermissionsController::class, 'update'])->name('update');
        Route::delete('destroy', [RolePermissionsController::class, 'destroy'])->name('destroy');

        Route::get('create_permission', [RolePermissionsController::class, 'createPermission'])->name('createPermission');
    });

    Route::group(['prefix'=>'publisher', 'as'=>'publisher.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('activation-req',      [PublisherController::class, 'activationReq'])->name('activationReq');
        Route::post('accept-decline-req', [PublisherController::class, 'acceptdeclineReq'])->name('acceptdeclineReq');
        Route::get('index',               [PublisherController::class, 'index'])->name('index');
        Route::get('create',              [PublisherController::class, 'create'])->name('create');
        Route::post('store',              [PublisherController::class, 'store'])->name('store');
        Route::get('edit/{id}',           [PublisherController::class, 'edit'])->name('edit');
        Route::post('update',             [PublisherController::class, 'update'])->name('update');
        Route::delete('destroy',          [PublisherController::class, 'destroy'])->name('destroy');
        Route::post('getdpublisher-data', [PublisherController::class, 'getPublisherData'])->name('getPublisherData');
    });

    Route::group(['prefix'=>'user', 'as'=>'user.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('index/{id}',  [UserController::class, 'index'])->name('index');
        Route::get('create/{id}', [UserController::class, 'create'])->name('create');
        Route::post('store',      [UserController::class, 'store'])->name('store');
        Route::get('edit/{id}',   [UserController::class, 'edit'])->name('edit');
        Route::post('update',     [UserController::class, 'update'])->name('update');
        Route::delete('destroy',  [UserController::class, 'destroy'])->name('destroy');
        Route::post('destroy_multiple',  [UserController::class, 'destroyMultiple' ])->name('destroyMultiple');
    });

    Route::group(['prefix'=>'heading', 'as'=>'heading.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('index',      [HeadingContoller::class, 'index'])->name('index');
        Route::post('store',     [HeadingContoller::class, 'store'])->name('store');
        Route::post('update',    [HeadingContoller::class, 'update'])->name('update');
        Route::delete('destroy', [HeadingContoller::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix'=>'keyword', 'as'=>'keyword.', 'middleware'=>['preventBackHistory', 'isLogged']], function () {
        Route::get('index/{heading_id}', [KeywordContoller::class, 'index'])->name('index');
        Route::get('list/{heading_id}',  [KeywordContoller::class, 'list'])->name('list');
        Route::post('store',             [KeywordContoller::class, 'store'])->name('store');
        Route::post('update',            [KeywordContoller::class, 'update'])->name('update');
        Route::delete('destroy',         [KeywordContoller::class, 'destroy'])->name('destroy');
        Route::post('destroy_multiple',  [KeywordContoller::class, 'destroyMultiple' ])->name('destroyMultiple');
    });

    Route::group(['prefix'=>'business', 'as'=>'business.'], function () {
        Route::get('index',     [AdminBusinessController::class, 'index'])->name('index');
        Route::get('edit/{id}', [AdminBusinessController::class, 'edit'])->name('edit');
        Route::post('update',   [AdminBusinessController::class, 'update'])->name('update');
    });

    Route::group([ 'prefix'=>'database','as'=>'database.' ], function(){
        Route::get('index',     [ DbImportExportController::class, 'index' ])->name('index');
        Route::get('export',    [ DbImportExportController::class, 'export' ])->name('export');
        Route::post('import',   [ DbImportExportController::class, 'import' ])->name('import');
    });

});



Route::group(['prefix' => 'frontend', 'as'=>'frontend.'], function () {
    Route::get('/',         [FrontendAuthController::class, 'index'])->name('login');
    Route::post('login',    [FrontendAuthController::class, 'login'])->name('login_post');
    Route::get('dashboard', [FrontendAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout',    [FrontendAuthController::class, 'logout'])->name('logout');

    Route::group(['prefix'=>'business', 'as'=>'business.', 'middleware'=>['preventBackHistory']], function () {
        Route::get('index',               [BusinessController::class, 'index'])->name('index');
        Route::get('create',              [BusinessController::class, 'create'])->name('create');
        Route::post('store',              [BusinessController::class, 'store'])->name('store');
        Route::get('edit/{id}',           [BusinessController::class, 'edit'])->name('edit');
        Route::post('update',             [BusinessController::class, 'update'])->name('update');
        Route::delete('destroy',          [BusinessController::class, 'destroy'])->name('destroy');
        Route::get('select_heading/{id}', [BusinessController::class, 'selectHeading'])->name('selectHeading');
        Route::get('get-headings',        [BusinessController::class, 'getHeadings'])->name('getHeadings');
        Route::post('assign_headings',    [BusinessController::class, 'assignHeadings'])->name('assignHeadings');
        Route::get('assign_image_keyword/{business_id}', [BusinessController::class, 'assignImageKeyword'])->name('assignImageKeyword');
        Route::post('upload_image',       [BusinessController::class, 'uploadImage'])->name('uploadImage');
        Route::post('additional_keyword', [BusinessController::class, 'storeAdditionalKeyword'])->name('storeAdditionalKeyword');
        Route::delete('destroy_keyword',  [BusinessController::class, 'destroyAdditionalKeyword'])->name('destroyAdditionalKeyword');
    });

    Route::group(['prefix'=>'publisher', 'as'=>'publisher.'], function () {
        Route::get('register',      [PublisherController::class, 'register'])->name('register');
        Route::post('registration', [PublisherController::class, 'registration'])->name('registration');
    });
    
    Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generatePDF');
});


Route::resource('students', StudentController::class);
