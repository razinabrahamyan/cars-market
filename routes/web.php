<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\TestController;
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
//Route::get('/', function () {
//    return view('welcome');
//})->middleware('auth.basic');

//Route::group(['middleware' => 'auth.basic'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/upload-file', [PDFController::class, 'index']);
    Route::get('/crawl',[TestController::class,'crawl']);
    Route::get('/vin',[TestController::class,'vin']);
//});

/*Route for testing*/
Route::get('/mytest/{action}', function ($action, Request $request) {
    $class = "App\\Http\\Controllers\\TestController";
    if (class_exists($class) && method_exists($class, $action)) {
        return (new $class())->callAction($action, [$request]);
    } else
        return response('Экшена '.$action.' не существует');
});
/*Route for testing*/

//Route::get('/upload-file', [PDFController::class, 'index']);
//Route::get('/crawl',[TestController::class,'crawl']);
//Route::get('/vin',[TestController::class,'vin']);
