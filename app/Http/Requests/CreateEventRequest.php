<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp,svg|max:2048',
            'address' => 'required|string|max:255',
            'num_tickets' => 'required',
            'city_id' => 'nullable',
            'country_id' => 'required'
        ];
    }
}
