<?php


namespace App\Modules\Authentication\Domain\Actions;


use App\Modules\Authentication\Domain\DataTransferObjects\UpdateUserDto;
use App\Modules\Authentication\Domain\Models\User;

class UpdateUserAction
{
    public function __invoke(User $user, UpdateUserDto $updateUserDto): bool
    {
        return $user->update($updateUserDto->toArray());
    }
}
