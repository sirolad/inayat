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
})->name('index');
//@todo clean this up
Route::get('/login',  function () {
    return view('welcome');
});
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::get('/dashboard', 'UsersController@index')->name('dashboard');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/edit-profile', 'UsersController@viewProfile')->name('view.profile');
Route::post('/edit-profile', 'UsersController@editProfile')->name('edit.profile');
Route::post('/change-password', 'UsersController@changePassword')->name('edit.password');
Route::post('/upload-image', 'UsersController@uploadImage')->name('upload.image');
Route::post('/update-kin', 'UsersController@updateKin')->name('edit.kin');
Route::get('/transaction', 'UsersController@showTransaction')->name('show.payment');
Route::post('/transaction', 'UsersController@makeTransaction')->name('make.payment');
Route::get('/forgot-password', 'Auth\ForgotPasswordController@forgot')->name('forgot');
Route::post('/forgot-password', 'Auth\ResetPasswordController@reset')->name('reset');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/create-account', 'AdminController@showAccount')->name('admin.create');
    Route::post('/create-account', 'AdminController@createAccount')->name('admin.post');
    Route::get('/members', 'AdminController@getMembers')->name('admin.members');
    Route::post('/verify-transaction/{id}', 'AdminController@verify')->name('admin.verify');
    Route::post('/decline-transaction/{id}', 'AdminController@decline')->name('admin.decline');
    Route::get('/view-member/{id}', 'AdminController@viewMembers')->name('admin.view');
    Route::get('/transact/{id}', 'AdminController@showTransaction')->name('show.transaction');
    Route::post('/transact/{id}', 'AdminController@makeTransaction')->name('admin.transaction');
    Route::get('/all-reports', 'AdminController@getReports')->name('admin.reports');
    Route::get('/excel-members', 'AdminController@csvMembers')->name('excel.members');
    Route::get('/excel-transactions', 'AdminController@csvTransactions')->name('excel.transactions');
});