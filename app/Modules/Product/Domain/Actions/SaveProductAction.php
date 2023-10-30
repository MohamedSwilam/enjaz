<?php
namespace App\Modules\Product\Domain\Actions;

use App\Modules\Product\Domain\DataTransferObjects\CreateProductDto;
use App\Modules\Product\Domain\Models\Product;

class SaveProductAction
{
    public function __invoke(CreateProductDto $createProductDto): Product
    {
        return Product::create($createProductDto->toArray());
    }
}
