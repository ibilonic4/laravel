<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ImageUploadController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        //Route::get('/register', 'RegisterController@show')->name('register.show'); ovo dolje je bolja varijanta sa view
        Route::view('/register','auth.register')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
       // Route::get('/login', 'LoginController@show')->name('login.show');
       Route::view('/login','auth.login')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
 //reset pass routes
      //  Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

      Route::view('forget-password','auth.forgetPassword')->name('forget.password.get');
      Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
      Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
      Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */

    //    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

 /**
         * Verify routes
         */
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

    
    
    });
//only verified account can access with this group
    Route::group(['middleware' => ['auth','verified']], function() {
        /**
         * Dashboard Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
});

Route::group(['middleware' => ['auth', 'permission']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    /**
     * User Routes
     */
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/create', 'UsersController@create')->name('users.create');
        Route::post('/create', 'UsersController@store')->name('users.store');
        Route::get('/{user}/show', 'UsersController@show')->name('users.show');
        Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
        Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    });

    /**
     * User Routes
     */
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/', 'PostsController@index')->name('posts.index');
        Route::get('/create', 'PostsController@create')->name('posts.create');
        Route::post('/create', 'PostsController@store')->name('posts.store');
        Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
        Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
        Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
        Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
    });
      
 

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    //forget-pass routes
//Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')-> name('forget.password.get');
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});




Route::get('image-upload',[ImageUploadController::class,'imageUpload'])->name('image.upload');
Route::post('image-upload',[ImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');







});