<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilityResource extends JsonResource
{
    protected static array $daysMap = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $days = explode(',', $this->day_of_week);

        $mappedDays = array_map(fn($d) => self::$daysMap[$d] ?? $d, $days);

        return [
            "workDays"     => $mappedDays,
            "startTime"    => $this->start_time,
            "endTime"      => $this->end_time,
        ];
    }
}
