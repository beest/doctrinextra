<?php

namespace Doctrinextra;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

interface Specification
{
    /**
     * @param \Doctrine\ORM\QueryBuilder $qb
     * @param string $dqlAlias
     * @return \Doctrine\ORM\Query\Expr
     */
    public function match(QueryBuilder $qb, $dqlAlias);

    /**
     * @param \Doctrine\ORM\Query $query
     */
    public function modifyQuery(AbstractQuery $query);
}
