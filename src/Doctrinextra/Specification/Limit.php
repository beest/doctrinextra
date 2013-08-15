<?php

namespace Doctrinextra\Specification;

use Doctrinextra\Specification;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class Limit implements Specification
{
    private $limit = 0;
    private $offset = 0;
    private $child;

    public function __construct($limit = 0, $offset = 0, Specification $child)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->child = $child;
    }

    public function modifyQuery(AbstractQuery $query)
    {
        if ($this->offset > 0) {
            $query->setFirstResult($this->offset);
        }

        if ($this->limit > 0) {
            $query->setMaxResults($this->limit);
        }

        // Propagate to child specification
        $this->child->modifyQuery($query);
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return $this->child->match($qb, $dqlAlias);
    }
}
