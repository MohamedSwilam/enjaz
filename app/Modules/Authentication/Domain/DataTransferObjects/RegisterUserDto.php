<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class RegisterUserDto extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?string $avatar;

    public bool $is_active;

    public int $user_type_id;

    public string $password;

    public string $role;

    public static function fromRequest(RegisterUserRequest $request): RegisterUserDto
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        return new self($data);
    }
}
