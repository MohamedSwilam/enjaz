<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\VerifyUserCodeRequest;
use Spatie\DataTransferObject\DataTransferObject;

class VerifyUserCodeDto extends DataTransferObject
{
    public int $user_id;

    public int $code;

    public static function fromRequest(VerifyUserCodeRequest $request): VerifyUserCodeDto
    {
        $data = $request->validated();

        return new self($data);
    }
}
