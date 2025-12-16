<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Plan extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'stripe_price_id',
        'stripe_product_id',
        'description',
        'price',
        'currency',
        'interval',
        'interval_count',
        'trial_days',
        'sort_order',
        'is_active',
        'features',
        'limits',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'features' => 'array',
        'limits' => 'array',
    ];

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2) . '/' . $this->interval;
    }

    public static function findByStripePriceId(string $stripePriceId): ?self
    {
        return static::where('stripe_price_id', $stripePriceId)->first();
    }
}