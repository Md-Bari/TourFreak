@extends('index')

@section('content')
<div class="container mt-5">
    <h1>Welcome, {{ auth()->user()->name }}!</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger mt-3">Logout</button>
    </form>
</div>
@endsection
