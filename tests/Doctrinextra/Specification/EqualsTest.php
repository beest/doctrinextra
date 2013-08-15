<?php

use PHPUnit_Framework_TestCase as TestCase;
use Mockery as Mockery;
use Doctrine\ORM\AbstractQuery as Query;
use Doctrinextra\Specification as Spec;

class EqualsTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testMatch()
    {
        $expr = Mockery::mock('Doctrine\ORM\Query\Expr');
        $expr
            ->shouldReceive('eq')
            ->with('alias.field', ':field')
            ->once()
            ->andReturn('foobar');

        $queryBuilder = Mockery::mock('Doctrine\ORM\QueryBuilder');
        $queryBuilder
            ->shouldReceive('setParameter')
            ->with('field', 'value')
            ->once();
        $queryBuilder
            ->shouldReceive('expr')
            ->once()
            ->andReturn($expr);

        $equals = new Spec\Equals('field', 'value');
        $output = $equals->match($queryBuilder, 'alias');

        $this->assertEquals($output, 'foobar');
    }
}
