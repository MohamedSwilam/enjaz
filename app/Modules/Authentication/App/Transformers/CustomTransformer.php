<?php

namespace App\Modules\Authentication\App\Transformers;

use League\Fractal\TransformerAbstract;

class CustomTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($data)
    {
        return $data;
    }
}
