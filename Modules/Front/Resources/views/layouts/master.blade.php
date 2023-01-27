<!DOCTYPE html>
<html>
    @include('front::layouts.css')
<body>
	@include('front::layouts.header')
	@yield('content')
	@include('front::layouts.footer')
	@include('front::layouts.js')
    @include('sweetalert::alert')
</body>
    @toastr_render
</html>

