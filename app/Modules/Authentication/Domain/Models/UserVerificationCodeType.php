<?php

namespace App\Modules\Authentication\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserVerificationCodeType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    public function userVerificationCodes(): HasMany
    {
        return $this->hasMany(UserVerificationCode::class);
    }
}
