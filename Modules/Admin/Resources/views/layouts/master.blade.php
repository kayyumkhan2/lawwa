<!DOCTYPE html>
<html>
    @include('admin::layouts.css')
<body>
        @include('admin::layouts.header')
        @include('admin::layouts.sidebar')
        @yield('content')
        @include('admin::layouts.footer')
</div>
    @include('admin::layouts.js')
    {!! Toastr::render() !!}
    @include('sweetalert::alert')
</body>
</html>

