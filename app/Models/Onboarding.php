<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;


class Onboarding extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'sort_order',
        'title',
        'slug'
    ];

    // Automatically generate UUID when creating a company
    protected static function booted()
    {
        static::creating(function ($onboarding) {
            if (! $onboarding->id) {
                $onboarding->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Get all of the onboardingsteps for the user.
     */
    public function onboardingSteps(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, OnboardingStep::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
