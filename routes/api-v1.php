<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [LoginController::class, 'store']);

Route::post('register', [RegisterController::class, 'store'])->name('api.v1.register');

/* Route::get('categories', [CategoryController::class, 'index'])->name('api.vi.categories.index');
Route::post('categories', [CategoryController::class, 'store'])->name('api.vi.categories.store');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('api.vi.categories.show');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('api.vi.categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('api.vi.categories.destroy');
 */
Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');

Route::apiResource('posts', PostController::class)->names('api.v1.posts');

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
