<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VdsController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\OrderController;

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
Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get("/register", [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post("/register", [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get("/login", [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post("/login", [LoginController::class, 'store'])->middleware('guest')->name('login.store');

Route::get("/logout", function () {
    Auth::logout();
    return redirect()->route('home');
})->middleware('auth')->name('logout');
Route::get("/user/profile", [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::post("/user/profile/save", [UserController::class, 'save'])->middleware('auth')->name('save_profile');

Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::get('/order/game/{id}', [OrderController::class, 'game'])->name('order.game');
Route::post('/order/buy', [OrderController::class, 'buy'])->middleware('auth')->name('order.buy');
Route::get('/cupon', function (){return '{"sum": 15"}';});
//Route::get('/order/web/{id}', [OrderController::class, 'web'])->name('order.web');


Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get("/", function () {
        return view('admin.index');
    })->name('admin.index');

    Route::prefix('news')->group(function () {
        Route::get("/", [NewsController::class, 'admin_news'])->name('admin.news');
        Route::get("/edit/{id}", [NewsController::class, 'edit'])->name('admin.news.edit');
        Route::post("/edit/{id}", [NewsController::class, 'update'])->name('admin.news.update');
        Route::get("/destroy/{id}", [NewsController::class, 'destroy'])->name('admin.news.destroy');
        Route::post("/create", [NewsController::class, 'store'])->name('admin.news.store');
        Route::get("/create", [NewsController::class, 'create'])->name('admin.news.create');
    });

    Route::prefix('users')->group(function () {
        Route::get("/", [UserController::class, 'users'])->name('admin.users');
        Route::get("/edit/{id}", [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post("/edit/{id}", [UserController::class, 'update'])->name('admin.users.update');
        Route::get("/destroy/{id}", [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
    Route::prefix('location')->group(function () {
        Route::get("/", [LocationController::class, 'location'])->name('admin.location');
        Route::get("/create", [LocationController::class, 'create'])->name('admin.location.create');
        Route::post("/create", [LocationController::class, 'store'])->name('admin.location.store');
        Route::get("/edit/{id}", [LocationController::class, 'edit'])->name('admin.location.edit');
        Route::post("/edit/{id}", [LocationController::class, 'update'])->name('admin.location.update');
        Route::get("/destroy/{id}", [LocationController::class, 'destroy'])->name('admin.location.destroy');
    });

    Route::prefix('vds')->group(function () {
        Route::get("/", [VdsController::class, 'vds'])->name('admin.vds');
        Route::get("/create", [VdsController::class, 'create'])->name('admin.vds.create');
        Route::post("/create", [VdsController::class, 'store'])->name('admin.vds.store');
        Route::get("/edit/{id}", [VdsController::class, 'edit'])->name('admin.vds.edit');
        Route::post("/edit/{id}", [VdsController::class, 'update'])->name('admin.vds.update');
        Route::get("/destroy/{id}", [VdsController::class, 'destroy'])->name('admin.vds.destroy');
    });

    Route::prefix('games')->group(function () {
        Route::get("/", [GameController::class, 'games'])->name('admin.games');
        Route::get("/create", [GameController::class, 'create'])->name('admin.games.create');
        Route::post("/create", [GameController::class, 'store'])->name('admin.games.store');
        Route::get("/edit/{id}", [GameController::class, 'edit'])->name('admin.games.edit');
        Route::post("/edit/{id}", [GameController::class, 'update'])->name('admin.games.update');
        Route::get("/destroy/{id}", [GameController::class, 'destroy'])->name('admin.games.destroy');
    });

    Route::prefix('rates')->group(function () {
        Route::get("/", [RateController::class, 'rates'])->name('admin.rates');
        Route::get("/create", [RateController::class, 'create'])->name('admin.rates.create');
        Route::post("/create", [RateController::class, 'store'])->name('admin.rates.store');
        Route::get("/edit/{id}", [RateController::class, 'edit'])->name('admin.rates.edit');
        Route::post("/edit/{id}", [RateController::class, 'update'])->name('admin.rates.update');
        Route::get("/destroy/{id}", [RateController::class, 'destroy'])->name('admin.rates.destroy');
    });
});


