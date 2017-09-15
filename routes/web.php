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

Route::get('/', 'HomeController@index');
Route::get('{locale}', 'HomeController@index')
        ->where('locale', implode('|', Config::get('app.locales')));

Route::middleware(['auth'])->group(function () {
    Route::get('admin', 'Admin\\HomeController@index');
    Route::get('{locale}/admin', 'Admin\\HomeController@index')
            ->where('locale', implode('|', Config::get('app.locales')));
//////////////
    Route::get('admin/users', function() {
        return View::make("admin.users");
    });
    Route::get('{locale}/admin/users', function() {
        return View::make("admin.users");
    })->where('locale', implode('|', Config::get('app.locales')));
//////////////
    Route::get('admin/table', function() {
        return View::make("admin.table");
    });
    Route::get('{locale}/admin/table', function() {
        return View::make("admin.table");
    })->where('locale', implode('|', Config::get('app.locales')));
//////////////
    Route::get('admin/typo', function() {
        return View::make("admin.typo");
    });
    Route::get('{locale}/admin/typo', function() {
        return View::make("admin.typo");
    })->where('locale', implode('|', Config::get('app.locales')));
//////////////
    Route::get('admin/notify', function() {
        return View::make("admin.notify");
    })->where('locale', implode('|', Config::get('app.locales')));
    Route::get('{locale}/admin/notify', function() {
        return View::make("admin.notify");
    });
});
