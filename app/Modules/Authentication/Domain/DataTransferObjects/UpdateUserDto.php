<?php

namespace App\Modules\Authentication\Domain\DataTransferObjects;

use App\Modules\Authentication\App\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserDto extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?string $avatar;

    public bool $is_active;

    public int $user_type_id;

    public string $password;

    public ?array $roles;

    public ?array $permissions;

    public ?string $email_verified_at;

    public static function fromRequest(UpdateUserRequest $request): UpdateUserDto
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $request->user->password;
        }

        return new self($data);
    }
}
