<?php

use App\Http\Controllers\Api\FeatureController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\FlipController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletCategoryController;
use App\Http\Controllers\Api\WalletController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('register', RegisterController::class);

// FLIP WEBHOOK
Route::prefix('flip')->group(function () {
    Route::post('accept-payment', [FlipController::class, 'acceptPayment']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', function () {
        $user = User::find(Auth::id());

        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => __('auth.logout_success'),
        ]);
    });

    // Features
    Route::get('features', [FeatureController::class, 'index']);
    Route::post('features', [FeatureController::class, 'store']);
    Route::put('features/{id}', [FeatureController::class, 'update']);
    Route::delete('features/{id}', [FeatureController::class, 'destroy']);

    // Packages
    Route::get('packages', [PackageController::class, 'index']);
    Route::post('packages', [PackageController::class, 'store']);
    Route::put('packages/{id}', [PackageController::class, 'update']);
    Route::delete('packages/{id}', [PackageController::class, 'destroy']);

    // Wallet categories
    Route::prefix('wallet-categories')->group(function () {
        Route::get('/', [WalletCategoryController::class, 'index']);
        Route::post('/', [WalletCategoryController::class, 'store']);
        Route::put('/{id}', [WalletCategoryController::class, 'update']);
        Route::delete('/{id}', [WalletCategoryController::class, 'destroy']);
    });

    // Wallets
    Route::prefix('wallets')->group(function () {
        Route::get('/', [WalletController::class, 'index']);
        Route::get('/{id}', [WalletController::class, 'show']);
        Route::post('/', [WalletController::class, 'store']);
    });

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/wallets', [UserController::class, 'createWallet']);
    });
});

// login
Route::post('login', [LoginController::class, 'index']);
