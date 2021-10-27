<?php

use App\Http\Controllers\postController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::post('/delete', [postController::class, 'delete'])->middleware('auth');
Route::post('/update', [postController::class, 'update'])->middleware('auth');
Route::post("/getShowPost", [postController::class, 'getShowPost'])->middleware('auth');

Route::post('/get', [postController::class, 'get'])->middleware('auth');

Route::post('/create', [postController::class, 'create'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/sugangList', [postController::class, 'sugangList'])->name("sugangList")->middleware('auth');

Route::get('/kyoList', [postController::class, 'kyoList'])->name('kyoList')->middleware('auth');

Route::get('/kyoCreate', [postController::class, 'kyoCreate'])->name('kyoCreate')->middleware('auth');
