<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryShoppingController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShoppingLaunchController;
use App\Models\CategoryShopping;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [dashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/carter')->group(function () {
        Route::get('/launch', [ShoppingLaunchController::class, 'index'])->name('launch');
        Route::get('/category', [CategoryShoppingController::class, 'index'])->name('category');
        Route::get('/responsive', [BuyerController::class, 'index'])->name('responsive');
        Route::get('/cards', [CardController::class, 'index'])->name('cards');
        Route::get('/invoice', [ReportController::class, 'index'])->name('invoice');
        Route::get('/showInvoice', [ReportController::class, 'show'])->name('showInvoice');

        Route::get('/editCard/{card}', [CardController::class, 'edit'])->name('editCard');
        Route::get('/editCategory/{categoryShopping}', [CategoryShoppingController::class, 'edit'])->name('editCategory');
        Route::get('/editBuyer/{buyer}', [BuyerController::class, 'edit'])->name('editBuyer');
        Route::get('/editLaunch/{shoppingLaunch}', [ShoppingLaunchController::class, 'edit'])->name('editLaunch');

        Route::post('/addCard', [CardController::class, 'store'])->name('addCard');
        Route::post('/addCategory', [CategoryShoppingController::class, 'store'])->name('addCategory');
        Route::post('/addBuyer', [BuyerController::class, 'store'])->name('addBuyer');
        Route::post('/addLaunch', [ShoppingLaunchController::class, 'store'])->name('addLaunch');

        Route::put('/updateCard/{card}', [CardController::class, 'update'])->name('updateCard');
        Route::put('/updateCategory/{categoryShopping}', [CategoryShoppingController::class, 'update'])->name('updateCategory');
        Route::put('/updateBuyer/{buyer}', [BuyerController::class, 'update'])->name('updateBuyer');
        Route::put('/updateLaunch/{shoppingLaunch}', [ShoppingLaunchController::class, 'update'])->name('updateLaunch');

        Route::delete('/destroy/card/{card}', [CardController::class, 'destroy'])->name('destroyCard');
        Route::delete('/destroy/launch/{shoppingLaunch}', [ShoppingLaunchController::class, 'destroy'])->name('destroyLaunch');
        Route::delete('/destroy/responsive/{buyer}', [BuyerController::class, 'destroy'])->name('destroyBuyer');
        Route::delete('/destroy/category/{categoryShopping}', [CategoryShoppingController::class, 'destroy'])->name('destroyCategory');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__ . '/auth.php';
