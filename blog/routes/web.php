<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
Route::get('/', [HomeController::class, 'index']);
Route::get('/more-post', [HomeController::class, 'loadMore']);
Route::prefix('/blogs')->group(function () {
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'postRegister'])->name('register.post');
});

Route::prefix('/account')->middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile-setting', [AuthController::class, 'settingAccount']);
    Route::post('/change-avatar', [AuthController::class, 'changeAvatar']);
    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
});
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'sendEmailContact'])->name('contact.send');
Route::resource('/about', AboutController::class);

// / dashboard admin

Route::prefix('/admin')->middleware('checkAdminLogin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->withoutMiddleware('checkAdminLogin');
    Route::post('/login', [LoginController::class, 'checkAdminLogin'])->name('admin.login')->withoutMiddleware('checkAdminLogin');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/users', UserController::class);
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy')->middleware('checkAdminDelete');
    Route::resource('/categories', CategoryController::class);
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('checkAdminDelete');
    Route::resource('/tags', TagController::class);
    Route::delete('/tags/{id}/delete', [TagController::class, 'destroy'])->name('tags.destroy')->middleware('checkAdminDelete');
    Route::resource('/posts', AdminPostController::class);
    Route::delete('/posts/{id}/delete', [AdminPostController::class, 'destroy'])->name('posts.destroy')->middleware('checkAdminDelete');
    Route::resource('/post-tags', PostTagController::class);
    Route::resource('/comments', CommentController::class);
    Route::delete('/comments/{id}/delete', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('checkAdminDelete');
});
