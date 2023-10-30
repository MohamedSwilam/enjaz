<?php

namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;

class DeleteUserAction
{
    public function __invoke(User $user): ?bool
    {
        return $user->delete();
    }
}
