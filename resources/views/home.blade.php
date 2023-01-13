@extends("layout")

@section("body")
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        <a href="{{ route('list') }}" class="btn btn-primary">Main Page</a>
    @endguest
    @auth
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        <a href="{{ route('list') }}" class="btn btn-primary">Main Page</a>
        <a href="{{ route('admin') }}" class="btn btn-primary">Admin</a>
    @endauth
@endsection