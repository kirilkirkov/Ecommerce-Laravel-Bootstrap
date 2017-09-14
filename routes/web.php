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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/admin/{locale?}', 'Admin\\HomeController@index')->middleware('auth');

Route::get('/admin/{locale}/users', function() {
    return View::make("admin.users");
})->middleware('auth');

Route::get('/admin/table', function() {
    return View::make("admin.table");
})->middleware('auth');

Route::get('/admin/typo', function() {
    return View::make("admin.typo");
})->middleware('auth');

Route::get('/admin/notify', function() {
    return View::make("admin.notify");
})->middleware('auth');

