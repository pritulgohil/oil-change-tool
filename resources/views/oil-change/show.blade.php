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

<div class="result-grid">
    <section class="panel" aria-labelledby="why-title">
        <div class="panel-heading compact">
            <div>
                <span class="step-badge">2</span>
                <h2 id="why-title">Why this result?</h2>
            </div>
        </div>

        <div class="assessment-list">
            <article class="assessment-item {{ $oilChangeCheck->due_to_distance ? 'assessment-warning' : 'assessment-ok' }}">
                <div class="assessment-status" aria-hidden="true">
                    {{ $oilChangeCheck->due_to_distance ? '!' : '✓' }}
                </div>
                <div>
                    <h3>Distance travelled</h3>
                    <p><strong>{{ number_format($oilChangeCheck->kilometres_since_last_change) }} km</strong> since the previous oil change.</p>
                    <small>
                        {{ $oilChangeCheck->due_to_distance ? 'More than the 5,000 km limit.' : 'At or below the 5,000 km limit.' }}
                    </small>
                </div>
            </article>

            <article class="assessment-item {{ $oilChangeCheck->due_to_time ? 'assessment-warning' : 'assessment-ok' }}">
                <div class="assessment-status" aria-hidden="true">
                    {{ $oilChangeCheck->due_to_time ? '!' : '✓' }}
                </div>
                <div>
                    <h3>Time elapsed</h3>
                    <p>
                        Previous change on
                        <strong>{{ $oilChangeCheck->previous_oil_change_date->format('F j, Y') }}</strong>.
                    </p>
                    <small>
                        {{ $oilChangeCheck->due_to_time ? 'More than six months ago.' : 'Within the six-month limit.' }}
                    </small>
                </div>
            </article>
        </div>
    </section>

    <aside class="panel details-panel" aria-labelledby="details-title">
        <div class="panel-heading compact">
            <div>
                <h2 id="details-title">Submitted details</h2>
            </div>
        </div>

        <dl class="details-list">
            <div>
                <dt>Current odometer</dt>
                <dd>{{ number_format($oilChangeCheck->current_odometer) }} km</dd>
            </div>
            <div>
                <dt>Previous change date</dt>
                <dd>{{ $oilChangeCheck->previous_oil_change_date->format('M j, Y') }}</dd>
            </div>
            <div>
                <dt>Previous odometer</dt>
                <dd>{{ number_format($oilChangeCheck->previous_oil_change_odometer) }} km</dd>
            </div>
            <div>
                <dt>Checked</dt>
                <dd>{{ $oilChangeCheck->created_at->format('M j, Y') }}</dd>
            </div>
        </dl>

        <a href="{{ route('oil-change.create') }}" class="button button-secondary">
            Check another car
        </a>
    </aside>
</div>
@endsection