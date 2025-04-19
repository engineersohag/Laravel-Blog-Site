<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'homepage'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('blog-post/{id}/details', [HomeController::class, 'blog_post_details'])->name('blog.details');

// Admin Routes (Only Admin Access)
Route::middleware(['auth', 'admin'])->group(function(){

    // Categories
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categoies/add', [AdminController::class, 'category_add'])->name('admin.categoies.add');
    Route::post('/admin/category/store', [AdminController::class, 'category_store'])->name('admin.categories.store');
    Route::get('/admin/category/{id}/edit', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/admin/category/update', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [AdminController::class, 'category_delete'])->name('admin.category.delete');

    // Blog Posts
    Route::get('/blog-post', [AdminController::class, 'blog_post'])->name('admin.blog.page');
    Route::get('/blog-post/add', [AdminController::class, 'blog_post_add'])->name('admin.blog.add');
    Route::post('/blog-post/store', [AdminController::class, 'blog_post_store'])->name('admin.blog.store');
    Route::get('/blog-post/{id}/edit', [AdminController::class, 'blog_post_edit'])->name('admin.blog.edit');
    Route::put('/blog-post/update', [AdminController::class, 'blog_post_update'])->name('admin.blog.update');
    Route::delete('/blog-post/{id}/delete', [AdminController::class, 'blog_post_delete'])->name('admin.blog.delete');

    // Users & Comments
    Route::get('/all-users', [AdminController::class, 'all_users'])->name('admin.all.users');
    Route::get('/all/comments', [AdminController::class, 'show_all_comments'])->name('admin.all.comments');
    Route::delete('/comment/{id}/delete', [AdminController::class, 'delete_comments'])->name('admin.delete.comment');
});


// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Blog Posts
    Route::get('/user/blog/add', [HomeController::class, 'user_blog_add'])->name('user.blog.add');
    Route::post('/user/blog/store', [HomeController::class, 'user_blog_store'])->name('user.blog.store');
    Route::get('/user/blogs', [HomeController::class, 'user_blogs'])->name('user.blogs');
    Route::get('/user/blog/{id}/edit', [HomeController::class, 'user_blog_edit'])->name('user.blog.edit');
    Route::put('/user/blog/update', [HomeController::class, 'user_blog_update'])->name('user.blog.update');
    Route::delete('/user/blog/{id}/delete', [HomeController::class, 'user_blog_delete'])->name('user.blog.delete');
    
    // Comments
    Route::post('/comments/{post}', [CommentController::class, 'comments_store'])->name('comments.store');


});

require __DIR__.'/auth.php';
