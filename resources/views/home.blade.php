@extends('layouts.app')

@section('title', config('app.name', 'Dev Snippets CMS'))

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
    <img src="{{ asset('programmer.gif') }}" alt="Dev Snippets Logo" class="img-fluid mb-3 rounded shadow"/>
    @if(isset($categories))
    <div class="text-secondary">
        <strong>{{ $categories->count() }}</strong> categories
        @php $snippetCount = $categories->sum(fn($cat) => $cat->snippets->count()); @endphp
        &middot; <strong>{{ $snippetCount }}</strong> snippets
    </div>
    @endif
</div>
@endsection

