<?php

namespace App\Modules\Authentication\App\Transformers;

use App\Modules\Authentication\Domain\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return $user->toArray();
    }
}
