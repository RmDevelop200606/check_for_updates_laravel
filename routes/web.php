<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HasBlogController;
use App\Http\Controllers\NoBlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\NotActiveCustomerController;
use App\Http\Controllers\CustomerPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LineRegisterController;
use App\Http\Controllers\ActiveCallController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PysettingController;
use App\Http\Controllers\PysettingTagToExludeController;
use App\Http\Controllers\PysettingUrlWordController;
// use App\Http\Controllers\PysettingController;
use App\Http\Controllers\CSVOutputController;
use App\Http\Controllers\AddNewCustomersController;
use Illuminate\Support\Facades\File;


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
    return view('top-page');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// トップページ、user編集ページ
Route::resource('user', UserController::class)
    ->middleware(['auth', 'record'])
    ->only(['index','edit', 'update']);

// 顧客一覧表示
Route::resource('customer', CustomerController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// 顧客ページ一覧
Route::resource('customer-page', CustomerPageController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// ブログあり
Route::get('/hasblog', [HasBlogController::class, 'index'])
    ->middleware(['auth'])
    ->name('hasblog.index');

// ブログあり(更新あり)
Route::get('/hasblog-updated', [HasBlogController::class, 'updated'])
    ->middleware(['auth'])
    ->name('hasblog.updated');

// ブログなし
Route::resource('noblog', NoBlogController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// 非アクティブ顧客一覧表示
Route::resource('not-active', NotActiveCustomerController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// ライン登録変更
Route::post('/linepost', [LineRegisterController::class, 'update'])
    ->middleware(['auth']);

// アクティブコール登録機能
Route::resource('activecall', ActiveCallController::class)
    ->middleware(['auth'])
    ->only(['store']);

// 口コミ登録機能
Route::resource('review', ReviewController::class)
    ->middleware(['auth'])
    ->only(['store']);

Route::get('/writecustomerid', [LineRegisterController::class, 'writeCustomerId'])
    ->middleware(['auth'])
    ->name('writecustomerid');

// 検索機能
Route::get('/search', [SearchController::class, 'index'])
    ->middleware(['auth'])
    ->name('search.index');

Route::post('/search/result', [SearchController::class, 'result'])
    ->middleware(['auth'])
    ->name('search.result');

// Pythonコントローラー
Route::get('python', [PythonController::class, 'exec'])
    ->middleware(['auth'])
    ->name('python');

// Python設定-メイン画面
Route::get('pysetting', [PysettingController::class, 'index'])
    ->middleware(['auth'])
    ->name('pysetting.index');

// Python設定-スクレイピング除外タグ
Route::get('pysetting/tag-to-exlude', [PysettingTagToExludeController::class, 'index'])
    ->middleware(['auth'])
    ->name('pysetting.tag-to-exlude');

// Python設定-スクレイピング除外タグ
Route::post('pysetting/tag-to-exlude', [PysettingTagToExludeController::class, 'update'])
    ->middleware(['auth']);

// Python設定-スクレイピング除外タグ
Route::get('pysetting/tag-to-exlude/{page_id}', [PysettingTagToExludeController::class, 'delete'])
    ->middleware(['auth']);

// Python設定-URL許可/除外リスト
Route::get('pysetting/Url{OkorNg}Word', [PysettingUrlWordController::class, 'index'])
    ->middleware(['auth']);

// Python設定-URL許可/除外リスト-登録
Route::post('pysetting/Url{OkorNg}Word/', [PysettingUrlWordController::class, 'update'])
    ->middleware(['auth']);

// Python設定-URL許可/除外リスト-登録
Route::get('pysetting/Url{OkorNg}Word/{id}', [PysettingUrlWordController::class, 'delete'])
    ->middleware(['auth']);

// acquired_data コントローラー
Route::get('prehtml/{file_namepath}/{page_id}', function($file_namepath, $page_id){
        return File::get(app_path("Http/Controllers/python/acquired_data/" . $file_namepath . "/html/" . $page_id . ".html"));
    })->middleware(['auth']);

// different コントローラー
Route::get('different/{term}/{page_id}', function($term,$page_id){
        return File::get(app_path("Http/Controllers/python/different/" . $term . "_term/" . $page_id . ".html"));
    })->middleware(['auth']);

// CSV出力
Route::get('/csv', [CSVOutputController::class, 'index'])
    ->middleware(['auth', 'record'])
    ->name('csv.index');

Route::post('/csv', [CSVOutputController::class, 'makecsv'])
    ->middleware(['auth'])
    ->name('csv.makecsv');

// エクセルのアップロード
Route::get('/addNewCustomers', [AddNewCustomersController::class, 'index'])
    ->middleware('auth')
    ->name('excel');

Route::post('/addNewCustomers', [AddNewCustomersController::class, 'openExcel'])
    ->middleware('auth')
    ->name('excel.upload');



require __DIR__.'/auth.php';
