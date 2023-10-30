<?php
namespace App\Modules\Product\Domain\Actions;

use App\Modules\Product\Domain\DataTransferObjects\UpdateProductDto;
use App\Modules\Product\Domain\Models\Product;

class UpdateProductAction
{
    /**
     * @param Product $product
     * @param UpdateProductDto $productDto
     * @return bool
     */
    public function __invoke(Product $product, UpdateProductDto $productDto): bool
    {
        return $product->update($productDto->toArray());
    }
}
