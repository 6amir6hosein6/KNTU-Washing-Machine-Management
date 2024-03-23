<?php

namespace App\Helper;

use App\Models\Reserve;
use DateInterval;
use DateTime;
use Exception;
use Carbon\Carbon;

class ReserveHelper
{
    /**
     * @throws Exception
     */
    public static function getTimeSlots($date, $machine_id): array
    {
        $result = [];

        // Start time and End time
        $start = new DateTime(Reserve::StartTime);
        $end = new DateTime(Reserve::EndTime);

        $workDuration = Reserve::WorkDuration * 60;
        $restDuration = Reserve::RestDuration * 60;

        while ($start < $end) {
            $bucketEnd = clone $start;

            // Add the total duration
            $bucketEnd->add(new DateInterval('PT' . $workDuration . 'S'));

            // Make sure the bucket end is not beyond the end time
            if ($bucketEnd > $end) {
                $bucketEnd = clone $end;
            }

            // Add the bucket to the result array

            $startTimestamp = Carbon::parse($date . ' ' . $start->format('H:i'))->toDateTimeString();
            $reserved = Reserve::where([
                'start_at' => $startTimestamp,
                'machine_id' => $machine_id
            ])->first();
            if(!$reserved){
                $result[] = [
                    'start' => $start->format('H:i'),
                    'end' => $bucketEnd->format('H:i'),
                ];
            }

            // Move the start time to the next bucket
            $bucketEnd->add(new DateInterval('PT' . $restDuration . 'S'));
            $start = clone $bucketEnd;
        }

        return $result;
    }
}
