<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'blood_group_id', 'upazila_id', 'patient_name', 'hospital_name', 'address',
        'required_bags', 'required_at', 'contact_phone', 'status', 'verification_token', 'verified_at',
    ];

    protected function casts(): array
    {
        return ['required_at' => 'datetime', 'verified_at' => 'datetime'];
    }

    public function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }
}
