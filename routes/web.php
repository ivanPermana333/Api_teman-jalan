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
    return view('auth.login');
});

Auth::routes();

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("users", "UserController");

// Route::resource("fields", "FieldController");

Route::resource("temans", "TemanController");

Route::resource("bookings", "BookingController");

Route::resource("schedules", "ScheduleController");

Route::resource("insertteman", "InsertController");

Route::resource("userteman", "UserTemanController");
Route::get('/registerteman', 'InsertController@create');
Route::post('/registerteman', 'InsertController@register');
Route::get('/loginteman', 'InsertController@show');
Route::post('/loginteman', 'InsertController@login');
Route::get('/userteman','UserTemanController@index');
Route::get('/userteman/{id}','UserTemanController@bookings');
Route::get('/bukti_pembayaran/{id}','BookingController@show');
Route::put('/bukti_pembayaran/{id}','BookingController@payment');


