@extends('layouts.app')

@section('title','Check your oil change status')

@section('content')
<section class="hero" aria-labelledby="page-title">
    <div class="hero-copy">
        <span class="eyebrow">Vehicle maintenance, simplified</span>
        <h1 id="page-title">Is your car due for an oil change?</h1>
        <p>
            Enter three details and get a clear answer based on distance travelled and time elapsed.
        </p>
    </div>
    <div class="rule-card" aria-label="Oil change rules">
        <div class="rule-item">
            <span class="rule-number">5,000</span>
            <span class="rule-label">kilometres</span>
        </div>
        <span class="rule-divider">or</span>
        <div class="rule-item">
            <span class="rule-number">6</span>
            <span class="rule-label">months</span>
        </div>
    </div>
</section>
<section class="panel form-panel" aria-labelledby="form-title">
    <div class="panel-heading">
        <div>
            <span class="step-badge">1</span>
            <h2 id="form-title">Vehicle details</h2>
        </div>
        <p>All fields are required.</p>
    </div>

    @if($errors->any())
    <div class="error-summary" role="alert" aria-labelledby="error-summary-title">
        <strong id="error-summary-title">Please review the highlighted fields.</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('oil-change.store') }}" class="check-form">
        @csrf

        <div class="field-grid">
            <div class="field field-wide">
                <label for="current_odometer">Current odometer</label>
                <div class="input-with-unit" @error('current_odometer') input-invalid @enderror>
                    <input type="number" id="current_odometer" name="current_odometer" inputmode="numeric" min-"0" max="9999999" step="1" value="{{ old('current_odometer') }}" placeholder="e.g. 84250" aria-describedby="current_odometer_help @error('current_odometer') current_odometer_error @enderror" @error('current_odometer') aria-invalid="true" @enderror required autofocus>
                    <span>km</span>
                </div>
                <p class="field-help" id="current_odometer_help">The reading shown on the vehicle today.</p>
                @error('current_odometer')
                <p class="field-error" id="current_odometer_error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="previous_oil_change_date">Previous oil change date</label>
                <input id="previous_oil_change_date" name="previous_oil_change_date" type="date" max="{{ $latestAllowedDate }}" value="{{ old('previous_oil_change_date') }}" aria-describedby="previous_oil_change_date_help @error('previous_oil_change_date') previous_oil_change_date_error @enderror" @error('previous_oil_change_date') aria-invalid="ture" @enderror required>
                <p class="field-help" id="previous_oil_change_date_help">This must be a date before today.</p>
                @error('previous_oil_change_date')
                <p class="field-error" id="previous_oil_change_date_error">{{ message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="previous_oil_change_odometer">Odometer at previous change</label>
                <div class="input-with-unit @error('previous_oil_change_odometer') input-invalid @enderror">
                    <input id="previous_oil_change_odometer" name="previous_oil_change_odometer" type="number" inputmode="numeric" min="0" max="9999999" type="number" step="1" value="{{ old('previous_oil_change_odometer') }}" placeholder="e.g. 79600" aria-describedby="previous_oil_change_odometer_help" @error('previous_oil_change_odometer') previous_oil_change_odometer_error @enderror @error('previous_oil_change_odometer') aria-invalid="true" @enderror required>
                    <span>km</span>
                </div>
                <p class="field-help" id="previous_oil_change_odometer_help">Use the reading recorded on your service receipt.</p>
                @error('previous_oil_change_odometer')
                <p class="field-error" id="previous_oil_change_odometer_error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="button button-primary">
                Check oil change status
                <svg viewBox="0 0 20 20" aria-hidden="true">
                    <path d="m7 4 6 6-6 6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
            <p>Your result is saved at a unique link so it remains available after refreshing.</p>
        </div>
    </form>
</section>
@endsection