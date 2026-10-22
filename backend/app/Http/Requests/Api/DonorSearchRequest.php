<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DonorSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blood_group_id' => ['nullable', 'exists:blood_groups,id'],
            'upazila_id' => ['nullable', 'exists:upazilas,id'],
            'availability_status' => ['nullable', 'in:available,unavailable,recently_donated'],
            'q' => ['nullable', 'string', 'max:120'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ];
    }
}
