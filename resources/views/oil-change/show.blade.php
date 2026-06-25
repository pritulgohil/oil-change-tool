@extends('layouts.app')

@section('title', $oilChangeCheck->is_due ? 'Oil change due' : 'Oil change not due')

@section('content')

<section class="result-hero {{ $oilChangeCheck->is_due ? 'result-due' : 'result-good' }}" aria-labelledby="result-title">
    <div class="result-icon" aria-hidden="true">
        @if ($oilChangeCheck->is_due)
        <svg viewBox="0 0 48 48">
            <path d="M24 5C18 14 11 21 11 30a13 13 0 0 0 26 0C37 21 30 14 24 5Z" fill="currentColor" />
            <path d="M24 20v11M24 36h.01" fill="none" stroke="white" stroke-linecap="round" stroke-width="3" />
        </svg>
        @else
        <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="19" fill="currentColor" />
            <path d="m15 24 6 6 12-13" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
        </svg>
        @endif
    </div>
    <div>
        <span class="eyebrow">Your maintenance result</span>
        <h1 id="result-title">
            {{ $oilChangeCheck->is_due ? 'Your car is due for an oil change.' : 'Your car is not due yet.' }}
        </h1>
        <p>
            @if ($oilChangeCheck->is_due)
            Schedule an oil change when practical to help keep the engine protected.
            @else
            Both the distance and time since the previous oil change are within the recommended limits.
            @endif
        </p>
    </div>
</section>
@endsection