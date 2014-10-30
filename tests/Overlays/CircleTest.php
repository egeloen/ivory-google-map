<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Circle;

/**
 * Circle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\Circle */
    private $circle;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $center;

    /** @var float */
    private $radius;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circle = new Circle($this->center = $this->createCoordinateMock(), $this->radius = 1);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->radius);
        unset($this->center);
        unset($this->circle);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->circle);
        $this->assertExtendableInstance($this->circle);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('circle_', $this->circle->getVariable());
        $this->assertSame($this->center, $this->circle->getCenter());
        $this->assertSame($this->radius, $this->circle->getRadius());
        $this->assertFalse($this->circle->hasOptions());
    }

    public function testSetCenter()
    {
        $this->circle->setCenter($center = $this->createCoordinateMock());

        $this->assertSame($center, $this->circle->getCenter());
    }

    public function testSetRadius()
    {
        $this->circle->setRadius($radius = 10);

        $this->assertSame($radius, $this->circle->getRadius());
    }

    public function testRenderExtend()
    {
        $this->circle->setVariable('circle');

        $this->assertSame('bound.union(circle.getBounds())', $this->circle->renderExtend($this->createBoundMock()));
    }
}
