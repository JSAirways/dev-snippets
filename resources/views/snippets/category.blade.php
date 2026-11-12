@extends('layouts.app')

@section('title', config('app.name', 'Dev Snippets CMS') . ' - ' . $category->name)

@section('content')
    @php
        $activeCategoryId = $category->id;
        unset($activeSnippetId);
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="my-3">[ {{ $category->name }} ]</h1>
                @if($category->description)
                <div class="mb-4 text-muted">{{ $category->description }}</div>
                @endif
                <div class="row g-4">
                    @forelse($category->snippets as $snippet)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('snippets.show', [$category->slug, $snippet->slug]) }}" style="text-decoration: none; color: inherit;">
                            <div class="card h-100 shadow-sm rounded-0">
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 2em;">
                                    <h5 class="card-title text-center mb-0">{{ $snippet->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-warning">No snippets in this category.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
