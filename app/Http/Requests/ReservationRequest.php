<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $search = session('search_params', []);

        return [
            'trip_id' => 'required|exists:trips,id',
            'return_trip_id' => 'nullable|exists:trips,id',
            'seat_numbers' => 'required|array|min:1|max:10',
            'seat_numbers.*' => 'required|integer|min:1',
            'return_seat_numbers' => 'nullable|array',
            'return_seat_numbers.*' => 'nullable|integer|min:1',
            'passenger_names' => 'required|array',
            'passenger_names.*' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $search = session('search_params', []);
            $totalPassengers = ($search['adults'] ?? 1) + ($search['children'] ?? 0);

            // Check if seat count matches passenger count
            if (count($this->seat_numbers) !== $totalPassengers) {
                $validator->errors()->add('seat_numbers', 'Number of selected seats must match total passengers.');
            }

            // Check for duplicate seats
            if (count($this->seat_numbers) !== count(array_unique($this->seat_numbers))) {
                $validator->errors()->add('seat_numbers', 'Duplicate seat selection detected.');
            }

            // Check if passenger names count matches
            if (count($this->passenger_names) !== $totalPassengers) {
                $validator->errors()->add('passenger_names', 'All passengers must have names.');
            }

            // Check return seats if round trip
            if ($this->return_trip_id && $this->return_seat_numbers) {
                if (count($this->return_seat_numbers) !== $totalPassengers) {
                    $validator->errors()->add('return_seat_numbers', 'Return seat count must match passenger count.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'passenger_names.*.regex' => 'Passenger names must only contain letters and spaces.',
        ];
    }
}
