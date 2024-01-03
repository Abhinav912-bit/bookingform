<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'booking_type' => 'required|in:FULL_DAY,HALF_DAY',
            'booking_date' => 'required|date',
            'booking_slot' => 'required|in:MORNING,EVENING,FULL_DAY',
            'booking_time' => 'required|date_format:H:i',
        ];
    }
}
