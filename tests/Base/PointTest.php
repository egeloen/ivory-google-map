<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Point
     */
    private $point;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->point = new Point();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->point);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('point', $this->point->getVariable());
        $this->assertSame(0.0, $this->point->getX());
        $this->assertSame(0.0, $this->point->getY());
    }

    public function testInitialState()
    {
        $this->point = new Point($x = 1.2, $y = 2.3);

        $this->assertStringStartsWith('point', $this->point->getVariable());
        $this->assertSame($x, $this->point->getX());
        $this->assertSame($y, $this->point->getY());
    }

    public function testX()
    {
        $this->point->setX($x = 1.2);

        $this->assertSame($x, $this->point->getX());
    }

    public function testY()
    {
        $this->point->setY($y = 1.2);

        $this->assertSame($y, $this->point->getY());
    }
}
