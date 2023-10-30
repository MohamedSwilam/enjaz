<?php


namespace App\Modules\Authentication\Domain\Actions;


use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserDto;
use App\Modules\Authentication\Domain\Models\User;

class CreateUserAction
{
    public function __invoke(CreateUserDto $createUserDto): User
    {
        return User::create($createUserDto->toArray());
    }
}
