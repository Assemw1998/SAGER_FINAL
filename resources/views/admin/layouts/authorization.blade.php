<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.includes.head')
    </head>
    <body>
        @include('admin.includes.header')

        @yield('content')
 
        @include('admin.includes.footer')
    </body>
</html>