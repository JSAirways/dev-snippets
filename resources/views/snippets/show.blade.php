@extends('layouts.app')

@section('title', config('app.name', 'Dev Snippets CMS') . ' - ' . $snippet->title)

@section('content')
    @php
        $activeCategoryId = $snippet->category->id;
        $activeSnippetId = $snippet->id;
    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('snippets.category', $snippet->category->slug) }}" class="btn btn-outline-light fw-bold rounded-0 my-3">&larr; Back to {{ $snippet->category->name }}</a>
                <section class="mt-4">
                    <h1>{{ $snippet->title }}</h1>
                    <div class="mb-3">{!! $snippet->description !!}</div>
                    @if($snippet->downloadLink && $snippet->downloadLink->count())
                    <div class="mt-3 mb-3">
                        @foreach($snippet->downloadLink as $link)
                        <a href="{{ $link->url }}" class="btn btn-outline-light fw-bold rounded-0 btn-sm me-2 mb-2" target="_blank" rel="noopener noreferrer">
                            {{ $link->title }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                    @if($snippet->code)
                    <div class="mb-3">
                        <button class="mt-5 btn btn-sm btn-light rounded-0 fw-bold" onclick="copyToClipboard('code-{{ $snippet->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy mb-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                            </svg>
                        </button>
                        <pre style="overflow-x: auto">
                            <code class="language-{{ $snippet->category->slug }}" id="code-{{ $snippet->id }}">{{ $snippet->code }}</code>
                        </pre>
                    </div>
                    @endif
                    @if($snippet->html)
                    <div class="mt-4">
                        <h4>Preview:</h4>
                        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; background: #000;">
                            {!! $snippet->html !!}
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script>
function copyToClipboard(id) {
    var code = document.getElementById(id).innerText;
    navigator.clipboard.writeText(code).then(function() {
        alert('Code copied to clipboard!');
    });
}
</script>
@endsection
