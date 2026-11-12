<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnippetController;

Route::get('/', function () {
    $categories = \App\Models\Category::with('snippets')->orderBy('display_order')->get();
    return view('home', compact('categories'));
});

// Snippet routes with slug-based URLs
Route::get('/snippets', [SnippetController::class, 'index'])->name('snippets.index');
Route::get('/category/{categorySlug}', [SnippetController::class, 'category'])->name('snippets.category')->where('categorySlug', '[a-z0-9\-]+');
Route::get('/category/{categorySlug}/{snippetSlug}', [SnippetController::class, 'show'])->name('snippets.show')->where(['categorySlug' => '[a-z0-9\-]+', 'snippetSlug' => '[a-z0-9\-]+']);

