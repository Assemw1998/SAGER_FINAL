<!DOCTYPE html>
<html lang="en">
    <head>
        @include('user.includes.head')
    </head>
    <body>
        @include('user.includes.header')

        @yield('content')
 
        @include('user.includes.footer')
    </body>
</html>