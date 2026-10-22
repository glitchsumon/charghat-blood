<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmergencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blood_group_id' => ['required', 'exists:blood_groups,id'],
            'upazila_id' => ['nullable', 'exists:upazilas,id'],
            'patient_name' => ['required', 'string', 'max:120'],
            'hospital_name' => ['required', 'string', 'max:190'],
            'address' => ['required', 'string', 'max:255'],
            'required_bags' => ['required', 'integer', 'min:1', 'max:10'],
            'required_at' => ['required', 'date', 'after_or_equal:now'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'verification_code' => ['required', 'digits:6'],
        ];
    }
}
