<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAction extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'action', 'subject_type', 'subject_id', 'metadata'];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }
}
