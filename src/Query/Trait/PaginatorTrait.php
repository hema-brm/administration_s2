<?php

namespace App\Query\Trait;

use Doctrine\ORM\Query;

trait PaginatorTrait {
    protected function decoratePaginator(Query $query, int $page, int $limit): Query {
        $offset = ($page - 1) * $limit;

        return $query
            ->setFirstResult($offset)
            ->setMaxResults($limit);
    }
}