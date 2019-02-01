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
    return view('loginPage');
});

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
//欲しい物リストページ
Route::group(['middleware' => ['auth']], function () {
    Route::get('accountLists', 'AccountListsController@index')->name('accountLists');
    Route::post('accountLists', 'AccountListsController@store')->name('accountLists.store');
    Route::delete('accountLists/{id}', 'AccountListsController@destroy')->name('accountLists.destroy');
    Route::get('accountLists/{id}', 'AccountListsController@edit')->name('accountLists.edit');
Route::post('accountLists/{id}', 'AccountListsController@update');
});
//ホーム・家計簿ページ
Route::group(['middleware' => ['auth']], function () {
    Route::get('show_exp', 'ExpensesController@indexShow_exp')->name('show_exp');
    Route::delete('show_exp/{id}', 'ExpensesController@destroy')->name('expenses.destroy');
    Route::get('write_exp', 'ExpensesController@indexWrite_exp')->name('write_exp');
    Route::post('write_exp', 'ExpensesController@store')->name('expenses.store');
    Route::get('past_exp', 'ExpensesController@indexPast_exp')->name('past_exp');
});
//予算等編集ページ
Route::group(['middleware' => ['auth']], function () {
    Route::get('edit_bud', 'EditController@index')->name('showEdit_bud');
    Route::post('edit_bud', 'EditController@store')->name('edit_bud.store');
    Route::get('edit_bud/{id}', 'EditController@edit')->name('edit_bud');
    Route::post('edit_bud/{id}', 'EditController@update');
});