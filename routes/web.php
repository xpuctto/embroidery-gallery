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

Route::get('/home', 'HomeController@index')->name('home');
