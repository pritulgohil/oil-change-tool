<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOilChangeCheckRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_odometer' => ['bail', 'required', 'integer', 'min:0', 'max:9999999', 'gte:previous_oil_change_odometer'],
            'previous_oil_change_date' => ['bail', 'required', 'date_format:Y-m-d', 'before:today'],
            'previous_oil_change_odometer' => ['bail', 'required', 'integer', 'min:0', 'max:9999999'],
        ];
    }

    /** @return array<string, string> */

    public function messages(): array
    {
        return [
            'current_odometer.gte' => 'The current odometer must be greateer than or equal to the odometer at the previous oil change.',
            'previous_oil_change_date.before' => 'The previous oil change date must be in the past.',
            '*.max' => 'Please enter a realistic odometer reading below 10,000,000 km.'
        ];
    }

    /** @return array<string, string> */

    public function attributes(): array
    {
        return [
            'current_odometer' => 'current odometer',
            'previous' => 'prevoious oil change date',
            'previous_oil_change_odometer' => 'odometer at previous oil change',
        ];
    }
}
