<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('layouts.header')
</head>

<body>
    <div id="app">
        @include('layouts.navbar')
        
        <main class="container py-4">
            @yield('content')
        </main>
    </div>
        
    <footer>
        @include('layouts.footer')
    </footer> 
    
</body>
</html>
