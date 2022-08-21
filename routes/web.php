<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchDetailController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileCoontroller;
use App\Http\Controllers\SquadController;
use Illuminate\Support\Facades\Auth;
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

// SEND PRODUCTION 2022

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/match', [HomeController::class, 'searchResult'])->name('searchResult');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [ProfileCoontroller::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileCoontroller::class, 'update'])->name('profile.update');
        Route::resources([
            'article' => ArticleController::class,
            'banner' => BannerController::class,
            'game' => GameController::class,
            'match' => MatchDetailController::class,
            'partner' => PartnerController::class,
            'squad' => SquadController::class,
        ]);
    });
});

// SEND PRODUCTION 2022
