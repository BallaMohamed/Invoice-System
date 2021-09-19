<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('forntend/forntend.invoice_system') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('forntend/css/fontawesome/all.min.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(config('app.locale') == 'ar')
      <link rel="stylesheet" type="text/css" href="{{asset('forntend/css/bootstrap-rtl.css')}}">
    @endif

    @yield('style')
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
            
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('forntend/js/fontawesome/all.min.js') }}"></script>
    @yield('script')
</body>
</html>
