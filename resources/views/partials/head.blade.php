<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', config('app.name', 'Dev Snippets CMS'))</title>
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#343a40">
<meta name="msapplication-TileColor" content="#f8f9fa">
<meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">
<meta name="theme-color" content="#343a40">
@vite(['resources/css/app.css', 'resources/js/app.js'])
