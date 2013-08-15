<?php

use PHPUnit_Framework_TestCase as TestCase;
use Mockery as Mockery;
use Scripty\Repository\Specification as Spec;

class LimitTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testModifyQuery()
    {
        $query = Mockery::mock('Doctrine\ORM\AbstractQuery');
        $query
            ->shouldReceive('setMaxResults')
            ->with(123)
            ->once();
        $query
            ->shouldReceive('setFirstResult')
            ->with(456)
            ->once();

        $child = Mockery::mock('Scripty\Repository\Specification');
        $child
            ->shouldReceive('modifyQuery')
            ->with($query)
            ->once();

        $limit = new Spec\Limit(123, 456, $child);
        $limit->modifyQuery($query);
    }

    public function testMatch()
    {
        $queryBuilder = Mockery::mock('Doctrine\ORM\QueryBuilder');

        $child = Mockery::mock('Scripty\Repository\Specification');
        $child
            ->shouldReceive('match')
            ->with($queryBuilder, 'alias')
            ->once()
            ->andReturn('foobar');

        $limit = new Spec\Limit(123, 456, $child);
        $output = $limit->match($queryBuilder, 'alias');

        $this->assertEquals($output, 'foobar');
    }
}
