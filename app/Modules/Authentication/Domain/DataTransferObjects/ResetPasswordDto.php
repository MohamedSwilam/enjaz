<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class ResetPasswordDto extends DataTransferObject
{
    public int $code;

    public string $email;

    public string $password;

    public static function fromRequest(ResetPasswordRequest $request): ResetPasswordDto
    {
        $data = $request->validated();

        return new self($data);
    }
}
