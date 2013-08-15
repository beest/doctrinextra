<?php

namespace Doctrinextra\Specification;

use Doctrinextra\Specification;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class ArrayHydrate implements Specification
{
    private $child;

    public function __construct(Specification $child)
    {
        $this->child = $child;
    }

    public function modifyQuery(AbstractQuery $query)
    {
        $query->setHydrationMode(AbstractQuery::HYDRATE_ARRAY);

        // Propagate to child specification
        $this->child->modifyQuery($query);
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return $this->child->match($qb, $dqlAlias);
    }
}
