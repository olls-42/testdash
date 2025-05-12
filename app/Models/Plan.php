<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\DomainFactory> */
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'price',
        'features',
        'is_active'
    ];

    public function getFeaturesAttribute() {
        return json_decode($this->attributes['features'], true);
    }
}
