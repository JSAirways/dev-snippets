<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    @yield('head')
</head>
<body class="container-fluid">
    @auth
    <a class="btn btn-transparent text-light fixed-top ms-auto rounded-0 me-4 mt-2 fw-bold text-center" style="width: 3rem;height: 2.75rem" href="{{ url('/admin') }}" title="Admin">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
        </svg>
    </a>
    @endauth
    <div class="row">
        <div class="col-auto" id="sidebar-container" style="height: 100vh; overflow-y: auto;">@include('partials.sidebar')</div>
        <div class="col bg-dark text-light" style="height: 100vh; overflow-y: auto;">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
    @if(isset($activeSnippetId))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var el = document.getElementById('sidebar-snippet-{{ $activeSnippetId }}');
            var sidebar = document.getElementById('sidebar-container');
            if (el && sidebar) {
                // Try native scrollIntoView with block: 'center' and scroll only sidebar
                if (typeof el.scrollIntoView === 'function') {
                    el.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
                } else {
                    // Fallback: manual scroll
                    var elTop = el.offsetTop;
                    var elHeight = el.offsetHeight;
                    var sidebarHeight = sidebar.clientHeight;
                    sidebar.scrollTop = elTop - (sidebarHeight / 2) + (elHeight / 2);
                }
            }
        });
    </script>
    @endif
</body>
</html>
