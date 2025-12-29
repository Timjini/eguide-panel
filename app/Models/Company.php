<?php

namespace App\Models;

use App\Observers\CompanyObserver;
use App\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

#[ObservedBy([CompanyObserver::class])]

class Company extends Model
{
    use HasFactory, SoftDeletes, Billable;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        // Basic information
        'id',
        'name',
        'legal_name',
        'logo_path',
        'type',
        'invoicing_entity',

        // Contact information
        'contact_person',
        'website',
        'phone_1',
        'phone_2',

        // Address information
        'address',
        'post_code',
        'city',
        'district',
        'country',

        // Business information
        'vat_number',
        'currency_id',

        // Financial information
        'iban',
        'swift_code',

        // Additional fields
        'status',
        'preferred_language',
        'notes',
        'source',
    ];

    // Automatically generate UUID when creating a company
    protected static function booted()
    {
        static::creating(function ($company) {
            if (! $company->id) {
                $company->id = (string) Str::uuid();
            }
        });
    }

    // Relation: Company has many Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
