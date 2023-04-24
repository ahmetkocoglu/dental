<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => "datetime:d-m-Y",
    ];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'id', 'doctor_id');
    }
}
