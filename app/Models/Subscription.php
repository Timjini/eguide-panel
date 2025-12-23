<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [];

    // Automatically generate UUID
    protected static function booted()
    {
        static::creating(function ($subscription) {
            if (! $subscription->id) {
                $subscription->id = (string) Str::uuid();
            }
        });
    }
}
