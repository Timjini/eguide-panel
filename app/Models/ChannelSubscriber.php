<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ChannelSubscriber extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'channel_id',
        'joined_at',
        'status',
        'deleted_at',
    ];

    protected static function booted()
    {
        static::creating(function ($channelSubscriber) {
            if (! $channelSubscriber->id) {
                $channelSubscriber->id = (string) Str::uuid();
            }
        });
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
