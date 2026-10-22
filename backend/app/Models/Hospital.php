<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'map_url', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
