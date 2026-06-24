<?php

namespace App\Http\Controllers;

use App\Domain\OilChange\OilChangeAssessment;
use App\Http\Requests\StoreOilChangeCheckRequest;
use App\Models\OilChangeCheck;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OilChangeCheckController extends Controller
{
    public function create(): View
    {
        return view('oil-change.create', ['latestAllowedDate' => today()->subDay()->toDateString(),]);
    }

    public function store(StoreOilChangeCheckRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $assessment = OilChangeAssessment::assess(
            currentOdometer: (int) $validated['current_odometer'],
            previousOilChangeDate: CarbonImmutable::createFromFormat(
                'Y-m-d',
                $validated['previous_oil_change_date']
            )->startOfDay(),
            previousOilChangeOdometer: (int) $validated['previous_oil_change_odometer'],
            asOf: CarbonImmutable::today(),
        );

        $oilChangeCheck = DB::transaction(fn(): OilChangeCheck => OilChangeCheck::create([
            'current_odometer' => $validated['current_odometer'],
            'previous_oil_change_date' => $validated['previous_oil_change_date'],
            'previous_oil_change_odometer' => $validated['previous_oil_change_odometer'],
            'kilometres_since_last_change' => $assessment->kilometresSinceLastChange,
            'due_to_distance' => $assessment->dueToDistance,
            'due_to_time' => $assessment->dueToTime,
            'is_due' => $assessment->isDue,
        ]));

        return to_route('oil-change.show', $oilChangeCheck);
    }

    public function show(OilChangeCheck $oilChangeCheck): View
    {
        return view('oil-change.show', ['oilChangeCheck' => $oilChangeCheck]);
    }
}
