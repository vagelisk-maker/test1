<?php

namespace App\Requests\Payroll\OverTime;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class OverTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'nullable',
            'max_daily_ot_hours' => 'required|numeric|gt:0',
            'max_weekly_ot_hours' => 'required|numeric|gt:max_daily_ot_hours',
            'max_monthly_ot_hours' => 'required|gt:max_weekly_ot_hours',
            'valid_after_hour' => ['required', 'numeric', 'gt:0'],
            'pay_type' => ['required','in:0,1'],
            'overtime_pay_rate' => ['nullable','required_if:pay_type,1','numeric','gt:0'],
            'pay_percent' => ['nullable','required_if:pay_type,0','numeric','gt:0'],
            'is_active' => ['required', 'boolean', Rule::in([1, 0])],
        ];

    }

    public function messages(): array
    {
        return [
            'max_daily_ot_hours.gt' => 'Max Daily OverTime Hours must be greater than 0.',
            'max_weekly_ot_hours.gt' => 'Max Weekly OverTime Hour must be greater than Max Daily OverTime Hours.',
            'max_monthly_ot_hours.gt'  => ' Max Monthly OverTime Hour must be greater than Max Weekly OverTime Hour',
            'valid_after_hour.gt'  => 'OverTime Valid After must be greater than 0',
            'overtime_pay_rate.gt' => 'OverTime Pay Rate must be greater than 0',
        ];
    }
}
