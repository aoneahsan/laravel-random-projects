<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/init_urp', [App\Http\Controllers\ConfigurationsController::class, 'site_setup']);

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();



Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [
        'uses' => 'AdminController@dashboard',
        'as' => 'admin.dashboard',   
    ]);

    Route::get('users', [
        'uses' => 'AdminController@get_all_users',
        'as' => 'admin.users.index',   
    ]);

    Route::get('user/{id}/show', [
        'uses' => 'AdminController@show_single_user',
        'as' => 'admin.user.show',   
    ]);

    Route::get('user/create', [
        'uses' => 'AdminController@create_new_user',
        'as' => 'admin.user.create',   
    ]);

    Route::post('user/store', [
        'uses' => 'AdminController@store_new_user',
        'as' => 'admin.user.store',   
    ]);

    Route::get('user/{id}/edit', [
        'uses' => 'AdminController@edit_user',
        'as' => 'admin.user.edit',   
    ]);

    Route::post('user/{id}/update', [
        'uses' => 'AdminController@update_user',
        'as' => 'admin.user.update',   
    ]);

    Route::post('user/{id}/delete', [
        'uses' => 'AdminController@delete_user',
        'as' => 'admin.user.destroy',   
    ]);

    Route::get('plans', [
        'uses' => 'PlansController@get_all_plans',
        'as' => 'admin.plans.index',   
    ]);

    Route::get('plan/{id}/show', [
        'uses' => 'PlansController@show_single_plan',
        'as' => 'admin.plan.show',   
    ]);

    Route::get('plan/create', [
        'uses' => 'PlansController@create_new_plan',
        'as' => 'admin.plan.create',   
    ]);

    Route::post('plan/store', [
        'uses' => 'PlansController@store_new_plan',
        'as' => 'admin.plan.store',   
    ]);

    Route::get('plan/{id}/edit', [
        'uses' => 'PlansController@edit_plan',
        'as' => 'admin.plan.edit',   
    ]);

    Route::post('plan/{id}/update', [
        'uses' => 'PlansController@update_plan',
        'as' => 'admin.plan.update',   
    ]);




    // Route::get('/admin/user/{id}/disable', 'Admin\AdminController@disable_user');
    // Route::get('/admin/user/{id}/enable', 'Admin\AdminController@enable_user');


    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::group(['namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth', 'user']], function () {

Route::group(['namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth']], function () {

    Route::post('user/update_email', [
        'uses' => 'UsersController@update_user_email',
        'as' => 'user.email.update',  
    ]);

    Route::post('user/update_password', [
        'uses' => 'UsersController@update_user_password',
        'as' => 'user.password.update',  
    ]);

    Route::get('domains', [
        'uses' => 'DomainController@index',
        'as' => 'user.domain.index',   
    ]);

    Route::get('domain/create', [
        'uses' => 'DomainController@create',
        'as' => 'user.domain.create',   
    ]);

    Route::post('domain/store', [
        'uses' => 'DomainController@store',
        'as' => 'user.domain.store',  
    ]);

    Route::get('domain/{id}/edit', [
        'uses' => 'DomainController@edit',
        'as' => 'user.domain.edit',   
    ]);

    Route::post('domain/{id}/update', [
        'uses' => 'DomainController@update',
        'as' => 'user.domain.update',  
    ]);

    Route::get('domain/{id}/show', [
        'uses' => 'DomainController@show',
        'as' => 'user.domain.show',   
    ]);

    Route::post('domain/{id}/delete', [
        'uses' => 'DomainController@destroy',
        'as' => 'user.domain.destroy',  
    ]);

    Route::get('posts', [
        'uses' => 'PostsController@index',
        'as' => 'user.post.index',   
    ]);

    Route::get('post/create', [
        'uses' => 'PostsController@create',
        'as' => 'user.post.create',   
    ]);

    Route::post('post/store', [
        'uses' => 'PostsController@store',
        'as' => 'user.post.store',   
    ]);

    Route::post('post/image/upload', [
        'uses' => 'PostsController@image',
        'as' => 'user.post.image',  
    ]);

    Route::get('post/{id}/edit', [
        'uses' => 'PostsController@edit',
        'as' => 'user.post.edit',   
    ]);

    Route::post('post/{id}/update', [
        'uses' => 'PostsController@update',
        'as' => 'user.post.update',   
    ]);

    Route::post('post/{id}/destroy', [
        'uses' => 'PostsController@destroy',
        'as' => 'user.post.destroy',   
    ]);
    
});



