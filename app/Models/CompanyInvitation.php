<?php

namespace App\Models;

use App\Domain\Company\Company;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInvitation extends Model
{
    use HasUuids;

    protected $table = 'company_invitations';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['company_id', 'email', 'invitation_code', 'expires_at', 'invited_by'];

    protected $dates = ['expires_at', 'accepted_at'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}