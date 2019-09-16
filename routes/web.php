<?php

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

Route::resources([
    'embroideries' => 'EmbroideryController',
    'symbols' => 'SymbolController',
    'regions' => 'RegionController',
    'stitches' => 'StitchController'
]);

// Handle cases where a vue defined route is accessed directly via URL
Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');

Route::post('admin/auth/register', 'AuthController@register');

Route::post('admin/auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('admin/auth/user', 'AuthController@user');
    Route::post('admin/auth/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('admin/auth/refresh', 'AuthController@refresh');
});
