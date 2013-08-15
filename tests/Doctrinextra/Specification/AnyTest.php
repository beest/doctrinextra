<?php

use PHPUnit_Framework_TestCase as TestCase;
use Mockery as Mockery;
use Doctrinextra\Specification as Spec;

class AnyTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testMatch()
    {
        $queryBuilder = Mockery::mock('Doctrine\ORM\QueryBuilder');

        $any = new Spec\Any;
        $expr = $any->match($queryBuilder, 'alias');

        $this->assertEquals($expr, '1=1');
    }
}
