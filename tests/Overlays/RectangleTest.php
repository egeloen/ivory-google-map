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

use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Rectangle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\Rectangle */
    private $rectangle;

    /** @var \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangle = new Rectangle($this->bound = $this->createBoundMock('rectangle_bound'));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->bound);
        unset($this->rectangle);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->rectangle);
        $this->assertExtendableInstance($this->rectangle);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('rectangle_', $this->rectangle->getVariable());
        $this->assertSame($this->bound, $this->rectangle->getBound());
        $this->assertFalse($this->rectangle->hasOptions());
    }

    public function testSetBound()
    {
        $this->rectangle->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    public function testRenderExtend()
    {
        $this->assertSame('bound.union(rectangle_bound)', $this->rectangle->renderExtend($this->createBoundMock()));
    }
}
