@extends('index')

@section('content')
<div class="main-content" style="margin-left: 200px; margin-top: 60px; padding: 20px;">
    <h2>My Profile</h2>
    <p>Name: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <!-- Add more user info or a profile edit form here -->
</div>
@endsection
