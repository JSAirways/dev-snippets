<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Category;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    public function index()
    {
        $categories = Category::with('snippets')->orderBy('display_order')->get();
        return view('snippets.index', compact('categories'));
    }

    public function show($categorySlug, $snippetSlug)
    {
        $snippet = Snippet::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->where('slug', $snippetSlug)->firstOrFail();

        $categories = Category::with('snippets')->orderBy('display_order')->get();
        return view('snippets.show', compact('snippet', 'categories'));
    }

    public function category($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->with('snippets')->firstOrFail();
        $categories = Category::with('snippets')->orderBy('display_order')->get();
        return view('snippets.category', compact('category', 'categories'));
    }
}
