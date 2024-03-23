<?php

namespace App\Rules;

use App\Models\Machine;
use App\Models\Reserve;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DoubleTimeReserve implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startTimestamp = Carbon::parse(request('date') . ' ' . request('time'))->toDateTimeString();
        $machine_id = Machine::where('code', request('machine_id'))->first()->id;
        $reserved = Reserve::where([
            'start_at' => $startTimestamp,
            'machine_id' => $machine_id
        ])->first();
       if($reserved){
           $fail('این زمان قبلا رزرو شده است');
       }
    }

}
