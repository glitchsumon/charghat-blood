<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'blood_group_id', 'upazila_id', 'weight_kg', 'medical_notes',
        'last_donated_at', 'availability_status', 'status', 'reviewed_by', 'review_note', 'reviewed_at',
    ];

    protected function casts(): array
    {
        return ['last_donated_at' => 'datetime', 'reviewed_at' => 'datetime'];
    }
}
