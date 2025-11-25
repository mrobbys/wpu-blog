<?php

use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/posts', function () {
    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(9)->withQueryString();

    return view('posts', [
        'title' => [
            'All Posts',
            'Category: '.(Category::firstWhere('slug', request('category'))->name ?? 'All Categories'),
            'Author: '.(User::firstWhere('username', request('author'))->name ?? 'All Authors'),
        ][(request('category') ? 1 : (request('author') ? 2 : 0))],
        'posts' => $posts,
    ]);
})->name('posts');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post,
        'title' => 'Post - '.$post->title,
    ]);
})->name('post');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    // index post
    Route::get('/dashboard', [PostDashboardController::class, 'index'])->name('dashboard.index');
    // create post
    Route::get('/dashboard/create', [PostDashboardController::class, 'create'])->name('dashboard.post.create');
    // store post
    Route::post('/dashboard', [PostDashboardController::class, 'store'])->name('dashboard.post.store');
    // edit post
    Route::get('/dashboard/{post:slug}/edit', [PostDashboardController::class, 'edit'])->name('dashboard.post.edit');
    // update post
    Route::put('/dashboard/{post:slug}', [PostDashboardController::class, 'update'])->name('dashboard.post.update');
    // show post
    Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])->name('dashboard.post.show');
    // delete post
    Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy'])->name('dashboard.post.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});

require __DIR__.'/auth.php';
