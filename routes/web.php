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
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\sshController;
use App\Http\Controllers\PysettingController;
use App\Http\Controllers\PysettingUrlWordController;
// use App\Http\Controllers\PysettingController;
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

// user編集ページ
Route::resource('user', UserController::class)
    ->middleware(['auth', 'record'])
    ->only(['index','edit', 'update']);

// analysisページ
Route::get('analysis',[AnalysisController::class, 'index'])
    ->middleware(['auth', 'record'])
    ->name('analysis.index');

// 顧客一覧表示
Route::resource('customer', CustomerController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// 顧客ページ一覧
Route::resource('customer-page', CustomerPageController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// ブログあり
Route::resource('hasblog', HasBlogController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

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

// sshコントローラー
Route::get('/ssh', [sshController::class, 'getfile'])
    ->middleware(['auth'])
    ->name('ssh');

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
    ->name('pysetting');

// Python設定-スクレイピング除外タグ
Route::get('pysetting/tag-to-exlude', [PysettingController::class, 'index'])
    ->middleware(['auth'])
    ->name('pysetting.tag-to-exlude');

// Python設定-URL許可/除外リスト
Route::get('pysetting/Url{OkorNg}Word', [PysettingUrlWordController::class, 'index'])
    ->middleware(['auth'])
    ->name('pysetting.Url{OkorNg}Word');

// Python設定-URL許可/除外リスト
Route::post('pysetting/Url{OkorNg}Word/', [PysettingUrlWordController::class, 'update'])
    ->middleware(['auth'])
    ->name('pysetting.Url{OkorNg}Word.update');

// acquired_data コントローラー
Route::get('prehtml/{file_namepath}/{page_id}', function($file_namepath, $page_id){
        return File::get(app_path("Http/Controllers/python/acquired_data/" . $file_namepath . "/html/" . $page_id . ".html"));
    })->middleware(['auth']);

// different コントローラー
Route::get('different/{term}/{page_id}', function($term,$page_id){
        return File::get(app_path("Http/Controllers/python/different/" . $term . "_term/" . $page_id . ".html"));
    })->middleware(['auth']);

    
require __DIR__.'/auth.php';
