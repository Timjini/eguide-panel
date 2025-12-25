<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class OnboardingStep extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'onboarding_id',
        'is_completed'
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

    // Relation: Company has many Users
    public function onboaring()
    {
        return $this->belongsTo(Onboarding::class);
    }
}
