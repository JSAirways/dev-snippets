<nav class="pb-4">
    <h2 class="px-4">
        <a href="/" style="text-decoration: none; color:inherit">
            <img src="{{ asset('android-chrome-192x192.png') }}" alt="Dev Snippets Logo" class="img-fluid d-inline-block" style="max-width: 100px"/>
            <div class="d-inline-block align-middle">Developer<br/>Snippets</div>
        </a>
    </h2>
    <ul class="list-group list-group-flush">
        @foreach($categories as $category)
            @php
                $isOpen = isset($activeCategoryId) && (int) $activeCategoryId === (int) $category->id;
                $collapseId = 'sidebar-category-' . $category->id;
                $hasSnippets = $category->snippets->count() > 0;
            @endphp
            <li class="list-group-item px-4 py-2 border-bottom" style="border: none; background: none;">
                @if($hasSnippets)
                    <button
                        type="button"
                        class="sidebar-category-toggle fw-bold w-100 text-start border-0 bg-transparent p-0 d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $collapseId }}"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="{{ $collapseId }}"
                    >
                        <span>{{ $category->name }}</span>
                        <svg class="sidebar-chevron flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="0.85em" height="0.85em" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                    <ul id="{{ $collapseId }}" class="list-group list-group-flush ms-3 collapse{{ $isOpen ? ' show' : '' }}">
                        @foreach($category->snippets as $snippet)
                            <li id="sidebar-snippet-{{ $snippet->id }}" class="list-group-item sub-item px-2 py-1 @if(isset($activeSnippetId) && $activeSnippetId == $snippet->id) active @endif" style="border: none; background: none;">
                                <a href="{{ route('snippets.show', [$category->slug, $snippet->slug]) }}" style="text-decoration: none;">
                                    {{ $snippet->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <span class="fw-bold text-muted">{{ $category->name }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
