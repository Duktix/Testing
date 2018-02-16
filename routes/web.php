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
/*
Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/authenticate/remote/{user}/{key}', 'ImpersonateUser@Impersonate');

Route::resource('pages', 'PagesController');
Route::get('/snippets/snippet', 'PagesController@snippets')->name('pages.snippets');
Route::resource('themes', 'ThemesController');

Route::post('pages/savehtml', 'PagesController@savehtml')->name('pages.savehtml');
Route::post('pages/saveimage', 'PagesController@saveimage')->name('pages.saveimage');
Route::post('pages/savecover', 'PagesController@savecover')->name('pages.savecover');
Route::get('pages/{id}/preview', 'PagesController@preview')->name('pages.preview');


Route::get('settings/header', 'SettingsController@header')->name('settings.header');
Route::resource('settings/menu', 'MenuController');
Route::get('settings/footer', 'SettingsController@footer')->name('settings.footer');
Route::get('settings/fonts', 'SettingsController@fonts')->name('settings.fonts');
Route::get('settings/colors', 'SettingsController@colors')->name('settings.colors');
Route::post('settings/header/save', 'SettingsController@saveSettings')->name('settings.saveheader');
Route::post('settings/menu/save', 'SettingsController@saveSettings')->name('settings.savemenu');
Route::post('settings/footer/save', 'SettingsController@saveSettings')->name('settings.savefooter');
Route::post('settings/fonts/save', 'SettingsController@saveSettings')->name('settings.savefonts');
Route::post('settings/colors/save', 'SettingsController@saveSettings')->name('settings.savecolors');



Route::get('/seeder', 'CreateSeeder@index');
Route::post('settings/resetdb', 'CreateSeeder@resetdb');
Route::get('settings/resetdbtest', 'CreateSeeder@resetdb');
Route::get('settings/update', 'CreateSeeder@update')->name('settings.update');

