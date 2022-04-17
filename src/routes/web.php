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

Route::get('/', [ThreadController::class, 'index'])->middleware('auth');
Route::post('/', [ThreadController::class, 'store']);

Route::post('/reply', [ReplyController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
