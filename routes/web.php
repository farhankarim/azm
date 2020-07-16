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

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('doctors')->name('doctors/')->group(static function() {
            Route::get('/',                                             'DoctorsController@index')->name('index');
            Route::get('/create',                                       'DoctorsController@create')->name('create');
            Route::post('/',                                            'DoctorsController@store')->name('store');
            Route::get('/{doctor}/edit',                                'DoctorsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DoctorsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{doctor}',                                    'DoctorsController@update')->name('update');
            Route::delete('/{doctor}',                                  'DoctorsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('nurses')->name('nurses/')->group(static function() {
            Route::get('/',                                             'NursesController@index')->name('index');
            Route::get('/create',                                       'NursesController@create')->name('create');
            Route::post('/',                                            'NursesController@store')->name('store');
            Route::get('/{nurse}/edit',                                 'NursesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'NursesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{nurse}',                                     'NursesController@update')->name('update');
            Route::delete('/{nurse}',                                   'NursesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('teachers')->name('teachers/')->group(static function() {
            Route::get('/',                                             'TeachersController@index')->name('index');
            Route::get('/create',                                       'TeachersController@create')->name('create');
            Route::post('/',                                            'TeachersController@store')->name('store');
            Route::get('/{teacher}/edit',                               'TeachersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TeachersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{teacher}',                                   'TeachersController@update')->name('update');
            Route::delete('/{teacher}',                                 'TeachersController@destroy')->name('destroy');
        });
    });
});