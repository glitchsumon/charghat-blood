<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'blood_group_id' => ['required', 'exists:blood_groups,id'],
            'upazila_id' => ['required', 'exists:upazilas,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'verification_code' => ['required', 'digits:6'],
        ];
    }
}
