@extends('pages.defaults')

@section('body')
<header>
@stack('headers')
</header>
<main class="h-100 overflow-x-hidden overflow-y-auto">
@yield('main', '')
</main>
<footer>
@stack('footers')
</footer>
@endsection
