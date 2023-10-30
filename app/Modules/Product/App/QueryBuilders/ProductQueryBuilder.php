<?php

namespace App\Modules\Product\App\QueryBuilders;

use App\Modules\Product\Domain\Models\Product;
use App\Support\Filters\FuzzyFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductQueryBuilder extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Product::query();

        parent::__construct($query, $request);

        $this
            ->allowedFilters([
                AllowedFilter::custom('search', new FuzzyFilter(
                    'name',
                )),
            ])
            ->allowedSorts(['name', 'price', 'is_active', 'created_at', 'updated_at']);
    }
}
