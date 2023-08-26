<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
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
Route::get('/',[HomeController::class, 'index']);
Route::get('/more-post',[HomeController::class, 'loadMore']);
Route::prefix('/blogs')->group(function(){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{titleName}', [PostController::class, 'show']);
    Route::get('/category/{categoryName}', [PostController::class, 'getPostByCategory']);
    Route::get('/tag/{tagName}', [PostController::class, 'getPostByTag']);
    Route::post('/{titleName}', [PostController::class, 'postComment'])->name('post.comment')->middleware('checkUserLogin');
    Route::post('/comment/reply', [PostController::class, 'postReply'])->name('post.reply')->middleware('checkUserLogin');
    Route::post('/post/like', [PostController::class, 'postLike'])->name('post.like')->middleware('checkUserLogin');
    Route::delete('/post/{id}/uncomment', [PostController::class, 'postUnComment'])->name('post.uncomment')->middleware('checkUserLogin');
    Route::delete('/post/{id}/uncommentreply', [PostController::class, 'postUnCommentReply'])->name('post.uncommentreply')->middleware('checkUserLogin');
});
Route::prefix('/account')->group(function(){
    Route::get('/login', [AccountController::class, 'login']);
    Route::post('/login', [AccountController::class, 'checkLogin']);
    Route::get('/logout', [AccountController::class, 'logout']);
    Route::get('/register', [AccountController::class, 'register']);
    Route::post('/register', [AccountController::class, 'checkRegister']);
    Route::get('/profile-setting', [AccountController::class, 'settingAccount']);
    Route::post('/change-avatar', [AccountController::class, 'changeAvatar']);
});

