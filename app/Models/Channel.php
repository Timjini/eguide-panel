<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Channel extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'code',
        'started_at',
        'ended_at',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($channel) {
            if (! $channel->id) {
                $channel->id = (string) Str::uuid();
            }
        });
    }
}
