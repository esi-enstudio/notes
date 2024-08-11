<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable{
    public function scopeSearch(Builder $builder, $term = ''): Builder
    {
        foreach ($this->searchable as $search)
        {
            if (str_contains($search, '.'))
            {
                $relation = Str::beforeLast($search, '.');
                $column = Str::afterLast($search, '.');
                $builder->orWhereRelation($relation, $column, 'LIKE', "%$term%");
                continue;
            }
            $builder->orWhere($search, 'LIKE', "%$term%");
        }

        return $builder;
    }
}
