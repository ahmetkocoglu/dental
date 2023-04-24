<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => "datetime:d-m-Y",
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }
}
