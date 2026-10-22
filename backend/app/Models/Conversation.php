<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['subject_type', 'subject_id', 'initiator_id', 'recipient_id', 'type'];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
