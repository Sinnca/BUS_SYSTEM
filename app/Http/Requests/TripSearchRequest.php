<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100|different:origin',
            'departure_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after:departure_date',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'nullable|integer|min:0|max:10',
            'bus_type' => 'nullable|in:deluxe,regular,any',
            'is_round_trip' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'destination.different' => 'Destination must be different from origin.',
            'return_date.after' => 'Return date must be after departure date.',
        ];
    }
}
