<?php

namespace App\Domain\OilChange;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use InvalidArgumentException;

final readonly class OilChangeAssessment
{
    public const DISTANCE_THRESHOLD_KM = 5000;
    public const TIME_THRESHOLD_MONTHS  = 6;

    private function __construct(
        public int $kilometresSinceLastChange,
        public bool $dueToDistance,
        public bool $dueToTime,
        public bool $isDue,
    ) {}

    public static function assess(
        int $currentOdometer,
        CarbonInterface $previousOilChangeDate,
        int $previousOilChangeOdometer,
        ?CarbonInterface $asOf = null,
    ): self {
        if ($currentOdometer < $previousOilChangeOdometer) {
            throw new InvalidArgumentException('The current odometer cannot be lower than the previous oil change odometer.');
        }

        $assessmentDate = CarbonImmutable::instance($asOf ?? now())->startOfDay();
        $previousDate = CarbonImmutable::instance($previousOilChangeDate)->startOfDay();

        $kilometresSinceLastChange = $currentOdometer - $previousOilChangeOdometer;
        $dueToDistance = $kilometresSinceLastChange > self::DISTANCE_THRESHOLD_KM;
        $dueToTime = $previousDate->lt($assessmentDate->subMonthsNoOverflow(self::TIME_THRESHOLD_MONTHS));


        return new self(
            kilometresSinceLastChange: $kilometresSinceLastChange,
            dueToDistance: $dueToDistance,
            dueToTime: $dueToTime,
            isDue: $dueToDistance || $dueToTime,
        );
    }
}
