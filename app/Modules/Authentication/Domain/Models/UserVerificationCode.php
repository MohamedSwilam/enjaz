<?php

namespace App\Modules\Authentication\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVerificationCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'user_id',
        'user_verification_code_type_id',
    ];

    protected $with = ['user', 'userVerificationCodeType'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function userVerificationCodeType(): BelongsTo
    {
        return $this->belongsTo(UserVerificationCodeType::class);
    }
}
