<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');
Route::get('/register', 'RegistrationController@show')
    ->name('register')
    ->middleware('guest');


Route::post('/login', 'LoginController@authenticate')->name('login');
Route::post('/register', 'RegistrationController@register');

Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/home', 'DashboardController@index');

    Route::post('users/change-user-status', 'UserLoginController@changeUserStatus');
    Route::post('products/change-status', 'ProductController@changeStatus');

    Route::get('/courier-drivers/{id}', 'CourierDriverController@viewOrEdit');

    Route::post('courier-drivers/add-courier-driver-temp', 'CourierDriverController@addCourierDriverTemp');
    Route::post('courier-drivers/add-courier-driver', 'CourierDriverController@addCourierDriver');

    Route::get('courier-drivers/edit-courier-driver-temp/{id}', 'CourierDriverController@editCourierDriverTemp');
    Route::get('courier-drivers/edit-courier-driver/{id}', 'CourierDriverController@editCourierDriver');

    Route::delete('courier-drivers/remove-courier-driver-temp/{id}', 'CourierDriverController@removeCourierDriverTemp');
    Route::delete('courier-drivers/remove-courier-driver/{id}', 'CourierDriverController@removeCourierDriver');

    Route::put('courier-drivers/update-courier-driver-temp/{id}', 'CourierDriverController@updateCourierDriverTemp');
    Route::put('courier-drivers/update-courier-driver/{id}', 'CourierDriverController@updateCourierDriver');

    Route::get('product-categories/fetch-product-categories', 'ProductCategoryController@fetchForSelect');
    Route::get('suppliers/fetch-suppliers', 'SupplierController@fetchForSelect');

    Route::post('product-categories', 'ProductCategoryController@store');

    Route::resource('suppliers', 'SupplierController');
    Route::resource('couriers', 'CourierController');
    Route::resource('products', 'ProductController');
    Route::post('/logout', 'LoginController@logout')->name('logout');


    View::composer(['*'], function ($view) {

        if (Auth::check()) {
            $user = App\User::find(Auth::user()->user_id);

            $view->with('authenticated_user', $user);
        }
    });
});
