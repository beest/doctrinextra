<?php

use PHPUnit_Framework_TestCase as TestCase;
use Mockery as Mockery;
use Doctrine\ORM\AbstractQuery as Query;
use Scripty\Repository\Specification as Spec;

class ArrayHydrateTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testModifyQuery()
    {
        $query = Mockery::mock('Doctrine\ORM\AbstractQuery');
        $query
            ->shouldReceive('setHydrationMode')
            ->with(Query::HYDRATE_ARRAY)
            ->once();

        $child = Mockery::mock('Scripty\Repository\Specification');
        $child
            ->shouldReceive('modifyQuery')
            ->with($query)
            ->once();

        $arrayHydrate = new Spec\ArrayHydrate($child);
        $arrayHydrate->modifyQuery($query);
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

        $arrayHydrate = new Spec\ArrayHydrate($child);
        $output = $arrayHydrate->match($queryBuilder, 'alias');

        $this->assertEquals($output, 'foobar');
    }
}
