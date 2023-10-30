<?php
namespace App\Modules\Product\App\Transformers;

use App\Modules\Product\Domain\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Product $product
     * @return array
     */
    public function transform(Product $product): array
    {
        $data = $product->toArray();

        $data["discount_percentage"] =  request()->user()->userType->discount_percentage."%";
        $data["price_after_discount"] =  round($data["price"] - ($data["price"] * request()->user()->userType->discount_percentage / 100), 2);

        return $data;
    }
}
