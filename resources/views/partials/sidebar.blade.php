<nav class="pb-4">
    <h2 class="px-4">
        <a href="/" style="text-decoration: none; color:inherit">
            <img src="{{ asset('android-chrome-192x192.png') }}" alt="Dev Snippets Logo" class="img-fluid d-inline-block" style="max-width: 100px"/>
            <div class="d-inline-block align-middle">Developer<br/>Snippets</div>
        </a>
    </h2>
    <ul class="list-group list-group-flush">
        @foreach($categories as $category)
            <li class="list-group-item px-4 py-2" style="border: none; background: none;">
                <a href="{{ route('snippets.category', $category->slug) }}" class="fw-bold" style="text-decoration: none; color: inherit;">
                    {{ $category->name }}
                </a>
                @if($category->snippets->count())
                    <ul class="list-group list-group-flush ms-3">
                        @foreach($category->snippets as $snippet)
                            <li id="sidebar-snippet-{{ $snippet->id }}" class="list-group-item sub-item px-2 py-1 @if(isset($activeSnippetId) && $activeSnippetId == $snippet->id) active @endif" style="border: none; background: none;">
                                <a href="{{ route('snippets.show', [$category->slug, $snippet->slug]) }}" style="text-decoration: none;">
                                    {{ $snippet->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
