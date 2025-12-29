<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

class Subscription extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_session',
        'stripe_price',
        'trial_ends_at',
        'deleted_at',
    ];

    // Automatically generate UUID
    protected static function booted()
    {
        static::creating(function ($subscription) {
            if (! $subscription->id) {
                $subscription->id = (string) Str::uuid();
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
