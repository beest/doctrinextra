<?php

namespace Doctrinextra\Specification;

use Doctrinextra\Specification;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class Equals implements Specification
{
    private $field = null;
    private $value = null;

    public function __construct($field, $value = null)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function modifyQuery(AbstractQuery $query)
    {
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        $qb->setParameter($this->field, $this->value);

        return $qb->expr()->eq($dqlAlias . '.' . $this->field, ':' . $this->field);
    }
}
