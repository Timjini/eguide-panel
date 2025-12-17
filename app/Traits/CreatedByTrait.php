<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedByTrait
{
    public static function bootCreatedByTrait()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $user = Auth::user();
                $user->company_id = $model->id;
                $user->save();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
