<?php

namespace App\Modules\Authentication\App\QueryBuilders;

use App\Modules\Authentication\Domain\Models\User;
use App\Support\Filters\FuzzyFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserQueryBuilder extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = User::query();

        parent::__construct($query, $request);

        $this
            ->allowedFilters([
                AllowedFilter::custom('search', new FuzzyFilter(
                    'name',
                    'email',
                )),
                AllowedFilter::scope('role'),
            ])
            ->allowedSorts(['name', 'email']);
    }
}
