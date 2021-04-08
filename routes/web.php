<?php

use App\Http\Controllers\FeedController;
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




Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    Route::get( 'feed', [ FeedController::class, 'index'])->name('feed.index');
    Route::post( 'feed', [ FeedController::class, 'store'])->name('feed.store');

    Route::post( '/like/{post:id}', [ FeedController::class, 'like'])->name('feed.like');
    Route::post( '/dislike/{post:id}', [ FeedController::class, 'dislike'])->name('feed.dislike');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});
