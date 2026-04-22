@extends('index')

@section('title', 'Create Support Ticket')
@section('page_title', 'Create Ticket')

@section('content')
<div class="page-shell form-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Support request</span>
            <h2>Create a new ticket</h2>
            <p>Describe your issue clearly and our team can follow it from a cleaner support workspace.</p>
        </div>
    </section>

    <section class="form-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('support.store') }}">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required value="{{ old('subject') }}">
            </div>

            <div class="mb-4">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
            </div>

            <div class="action-row">
                <a href="{{ route('support.index') }}" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-dark">Submit Ticket</button>
            </div>
        </form>
    </section>
</div>
@endsection
