<?php

namespace App\Support\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FuzzyFilter implements Filter
{
    /**
     * The fields that are searchable.
     *
     * @var array|string[]
     */
    protected array $fields;

    /**
     * FuzzyFilter constructor.
     *
     * @param string ...$fields
     */
    public function __construct(string ...$fields)
    {
        $this->fields = $fields;
    }

    /**
     * Attach the search queries by fields to the query builder.
     *
     * @param Builder $query
     * @param string $value
     * @param string $property
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        $query->where(
            function (Builder $builder) use ($value): void {
                foreach ($this->fields as $field) {
                    $parts = (array) $value;

                    foreach ($parts as $part) {
                        $builder->orWhere($field, 'LIKE', "%{$part}%");
                    }
                }
            }
        );

        return $query;
    }
}
