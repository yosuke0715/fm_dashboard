<?php

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
Auth::routes();
/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return redirect('/home'); });

/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user'], function() {
    Route::post('logout',   'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('/home', 'DashboardController@showDashboard')->name('home');
    Route::get('/bss-view', 'App\Http\Controllers\BssController@showBssPage');
    Route::get('/home', 'App\Http\Controllers\DashboardController@showDashboard')->name('home');
    Route::get('/bss-test', 'App\Http\Controllers\TestController@showBssTestPage');
    Route::get('/bss-test-resubmit', 'App\Http\Controllers\TestController@showBSSTestResubmit');
    Route::get('/bss-test-history', 'App\Http\Controllers\TestController@showBSSTestHistory');
    Route::get('/bss-desc', 'App\Http\Controllers\BssController@showBssDescPage');
    Route::get('/bss_sort/no', 'App\Http\Controllers\BssController@showBssDescPageAfterSort');
    Route::get('/bss-sort/search/{id}', 'App\Http\Controllers\BssController@showBssPageAfterSearch');
    Route::get('/bss-sort/sort/{id}', 'App\Http\Controllers\BssController@showBssPageAfterSort');
    Route::get('/bss-add-desc/{id}', 'App\Http\Controllers\BssController@showAddBSSDescripionPage');
    Route::post('/bss-add-desc', 'App\Http\Controllers\BssController@addBSSDescripion');
    Route::post('/bss-answer', 'App\Http\Controllers\TestController@addBSSAnswer');
    Route::get('/{user_id}/{BSS_id}/{achieve_id}', 'App\Http\Controllers\AjaxController@addBSSAchievement')->where('user_id', '[0-9]+')->where('BSS_id', '[0-9]+');
});

/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'App\Http\Controllers\Admin\LoginController@login');
});

/*
|--------------------------------------------------------------------------
| 4) Admin 管理者画面
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'App\Http\Controllers\Admin\DashboardController@showDashboard')->name('admin.home');
    Route::get('/bss-view', 'App\Http\Controllers\Admin\BSSController@showBSSPage');
    Route::get('/bss-test', 'App\Http\Controllers\Admin\TestController@showBssTestPage');
    Route::get('/bss-test/ok/{id}', 'App\Http\Controllers\Admin\TestController@saveOKStatusBSSTest');
    Route::get('/bss-test/ng/{id}', 'App\Http\Controllers\Admin\TestController@saveNGStatusBSSTest');
    Route::get('/bss-add', 'App\Http\Controllers\Admin\BSSController@showAddBSSPage');
    Route::get('/bss-score', 'App\Http\Controllers\Admin\ScoreController@showScorePage');
    Route::get('/bss-score/OK/{id}', 'App\Http\Controllers\Admin\ScoreController@addBSSOKFlag');
    Route::get('/bss-score/NG/{id}', 'App\Http\Controllers\Admin\ScoreController@addBSSNGFlag');
    Route::get('/add-category', 'App\Http\Controllers\Admin\CategoryController@showAddCategoryPage');
    Route::post('/add-category', 'App\Http\Controllers\Admin\CategoryController@addCategory');
    Route::post('/bss-add', 'App\Http\Controllers\Admin\BSSController@addBSS');
    Route::get('/bss-edit', 'App\Http\Controllers\Admin\BSSController@showEditPage');
    Route::get('/bss-progress', 'App\Http\Controllers\Admin\BSSController@showBSSProgressPage');
    Route::post('/bss-update', 'App\Http\Controllers\Admin\BSSController@updateBSS');
    Route::get('/bss-search/{id}', 'App\Http\Controllers\Admin\BSSController@searchBSS');
    Route::get('/bss-edit/{id}', 'App\Http\Controllers\Admin\BSSController@showEditBSSPage');
    Route::get('/bss-del/{id}', 'App\Http\Controllers\Admin\BSSController@deleteBSS');
});

