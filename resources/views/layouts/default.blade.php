<!doctype html>
<html>
    <head>
        @include('layouts.header')
    </head>
    <body>
        <div id="content">
            @yield('content')
        </div>

        @include('layouts.footer')

        @include('layouts.javascript')

    </body>
</html>