<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserDto extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?string $avatar;

    public bool $is_active;

    public int $user_type_id;

    public string $password;

    public ?array $roles;

    public ?array $permissions;

    public static function fromRequest(CreateUserRequest $request): CreateUserDto
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        return new self($data);
    }
}
