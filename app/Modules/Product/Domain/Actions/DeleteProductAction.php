<?php
namespace App\Modules\Product\Domain\Actions;

use App\Modules\Product\Domain\Models\Product;

class DeleteProductAction
{
    public function __invoke(Product $product): ?bool
    {
        return $product->delete();
    }
}
