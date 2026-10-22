<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_name' => $this->patient_name,
            'blood_group' => $this->bloodGroup?->name,
            'upazila' => $this->upazila?->name,
            'hospital_name' => $this->hospital_name,
            'address' => $this->address,
            'required_bags' => $this->required_bags,
            'required_at' => $this->required_at?->toIso8601String(),
            'contact_phone' => $this->contact_phone,
            'status' => $this->status,
        ];
    }
}
