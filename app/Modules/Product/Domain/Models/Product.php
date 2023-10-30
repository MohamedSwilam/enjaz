<?php

namespace App\Modules\Product\Domain\Models;

use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authentication\Domain\Models\UserVerificationCodeType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'slug',
        'is_active',
    ];

    protected $with = [];
}
