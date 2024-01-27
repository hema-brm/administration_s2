<?php

namespace App\Query\Trait;

use Doctrine\ORM\Query;

trait PaginatorTrait {
    protected function decoratePaginator(Query $query, int $page = 0, int $limit = 0): Query {
        $offset = ($page - 1) * $limit;

        return $query
            ->setFirstResult($offset)
            ->setMaxResults($limit);
    }
}