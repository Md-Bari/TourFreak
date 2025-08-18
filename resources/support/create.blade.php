@extends('dashboard.dashboard') {{-- সঠিক Master Layout File --}}

@section('content')
<div class="main-content">
    <div class="card">
        <div class="card-header" style="padding: 1rem 1.5rem; background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h4 style="margin-bottom: 0;">Create a New Support Ticket</h4>
        </div>
        <div class="card-body" style="padding: 1.5rem;">
            <form action="{{ route('support.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Describe your issue</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #1ab394; border-color: #1ab394;">Submit Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection