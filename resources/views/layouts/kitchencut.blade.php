<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title ?? 'Kitchencut Technical Exercise' }}</title>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <link rel="stylesheet" href="/css/app.css">
    </head>
<body>
    <header><h1>{{ $pageHeading ?? 'Kitchencut Technical Exercise' }}</h1></header>
    <a href="{{ route('invoices') }}">Search Invoices</a> <a href="{{ route('invoices.locations') }}">Search Locations</a>
    <main>
        @yield('content')
    </main>
</body>
</html> 