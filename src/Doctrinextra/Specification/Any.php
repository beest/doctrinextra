<?php

namespace Doctrinextra\Specification;

use Doctrinextra\Specification;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class Any implements Specification
{
    public function modifyQuery(AbstractQuery $query)
    {
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        // Match any record
        return '1=1';
    }
}
