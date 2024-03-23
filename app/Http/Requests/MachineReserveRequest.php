<?php

namespace App\Http\Requests;

use App\Rules\DoubleTimeReserve;
use Illuminate\Foundation\Http\FormRequest;

class MachineReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'machine_id' => 'required|exists:machines,code',
            'date' => ['required','date_format:Y-m-d',new DoubleTimeReserve()],
            'time' => 'required|date_format:H:i:s',
        ];
    }

    public function messages(): array
    {
        return [
            'machineCode.required' => 'یک لباسشویی انتخاب کنید',
            'machineCode.exists' => 'لباسشویی در خوابگاه مورد نظر وجود ندارد',

            'date.required' => 'تاریخ را وارد کنید',
            'date.date_format' => 'فرمت تاریخ را صحیح وارد کنید',

            'time.required' => 'زمان را وارد کنید',
            'time.date_format' => 'فرمت زمان را صحیح وارد کنید',
        ];
    }
}
