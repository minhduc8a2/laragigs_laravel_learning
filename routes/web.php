<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/', [ListingController::class, 'index']);
Route::get('/hello', function () {
    return response('<h1>Hello World!</h1>', 404,)->header('Content-Type', 'text/html');
});

Route::get('/posts', function () {

    return response()->json([
        'posts' => [
            [
                'title' => 'Post one'
            ]
        ]
    ]);
});

Route::get('/posts/{id}', function ($id) {
    ddd($id);
    return response('<h1>' . $id . '</h1>', 404,);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    return $request->name;
});

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');



Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

Route::get('/listings/{listing}', [ListingController::class, 'show']);

Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');



Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);
