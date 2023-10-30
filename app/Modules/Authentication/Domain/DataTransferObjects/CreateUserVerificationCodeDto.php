<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\CreateVerificationCodeRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserVerificationCodeDto extends DataTransferObject
{
    public ?string $email;

    public int $user_verification_code_type_id;

    public ?int $code;

    public static function fromRequest(CreateVerificationCodeRequest $request): CreateUserVerificationCodeDto
    {
        $data = $request->validated();

        if (!isset($data['email'])) {
            $data['email'] = $request->user()->email;
        }

        if (!isset($data['code'])) {
            $data['code'] = random_int(100000, 999999);
        }

        return new self($data);
    }
}
