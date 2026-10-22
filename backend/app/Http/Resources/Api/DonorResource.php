<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user?->name,
            'blood_group' => $this->bloodGroup?->name,
            'upazila' => $this->upazila?->name,
            'address' => $this->address,
            'photo_url' => $this->photo_url,
            'availability_status' => $this->availability_status,
            'last_donated_at' => $this->last_donated_at?->toIso8601String(),
            'avg_rating' => round((float) $this->reviews()->avg('rating'), 2),
            'reviews_count' => $this->reviews()->count(),
        ];
    }
}
