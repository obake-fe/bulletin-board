<?php

    use App\Http\Controllers\ReplyController;
    use App\Http\Controllers\ThreadController;
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

Route::get('/', [ThreadController::class, 'index']);
Route::post('/', [ThreadController::class, 'store']);

Route::post('/reply', [ReplyController::class, 'store']);
