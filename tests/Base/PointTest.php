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
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Point test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Base\Point */
    private $point;

    /** @var float */
    private $x;

    /** @var float */
    private $y;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->point = new Point($this->x = -1, $this->y = 1);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->point);
        unset($this->x);
        unset($this->y);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->point);
    }

    public function testInitialState()
    {
        $this->assertStringStartsWith('point_', $this->point->getVariable());
        $this->assertSame($this->x, $this->point->getX());
        $this->assertSame($this->y, $this->point->getY());
    }

    public function testSetX()
    {
        $this->point->setX($x = 10);

        $this->assertSame($x, $this->point->getX());
    }

    public function testSetY()
    {
        $this->point->setY($y = 10);

        $this->assertSame($y, $this->point->getY());
    }
}
