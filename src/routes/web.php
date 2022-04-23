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

Route::controller(ThreadController::class)->group(function () {
    Route::get('/', 'index')->middleware('auth')->name('root');
    Route::post('/', 'store');
    Route::get('/edit/{entry_id}', 'edit')->middleware('auth')->name('edit');
});


Route::post('/reply', [ReplyController::class, 'store'])->name('reply');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
