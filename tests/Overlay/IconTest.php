<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Overlay\Icon;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ivory\GoogleMap\Overlay\Icon
     */
    private $icon;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->icon = new Icon();
    }

    public function testDefaultState()
    {
        $this->assertSame('https://maps.gstatic.com/mapfiles/markers/marker.png', $this->icon->getUrl());
        $this->assertFalse($this->icon->hasAnchor());
        $this->assertNull($this->icon->getAnchor());
        $this->assertFalse($this->icon->hasOrigin());
        $this->assertNull($this->icon->getOrigin());
        $this->assertFalse($this->icon->hasScaledSize());
        $this->assertNull($this->icon->getScaledSize());
        $this->assertFalse($this->icon->hasSize());
        $this->assertNull($this->icon->getSize());
    }

    public function testInitialState()
    {
        $this->icon = new Icon(
            $url = 'foo',
            $anchor = $this->createPointMock(),
            $origin = $this->createPointMock(),
            $scaledSize = $this->createSizeMock(),
            $size = $this->createSizeMock()
        );

        $this->assertSame($url, $this->icon->getUrl());
        $this->assertTrue($this->icon->hasAnchor());
        $this->assertSame($anchor, $this->icon->getAnchor());
        $this->assertTrue($this->icon->hasOrigin());
        $this->assertSame($origin, $this->icon->getOrigin());
        $this->assertTrue($this->icon->hasScaledSize());
        $this->assertSame($scaledSize, $this->icon->getScaledSize());
        $this->assertTrue($this->icon->hasSize());
        $this->assertSame($size, $this->icon->getSize());
    }

    public function testUrl()
    {
        $this->icon->setUrl($url = 'foo');

        $this->assertSame($url, $this->icon->getUrl());
    }

    public function testAnchor()
    {
        $this->icon->setAnchor($point = $this->createPointMock());

        $this->assertTrue($this->icon->hasAnchor());
        $this->assertSame($point, $this->icon->getAnchor());
    }

    public function testResetAnchor()
    {
        $this->icon->setAnchor($this->createPointMock());
        $this->icon->setAnchor(null);

        $this->assertFalse($this->icon->hasAnchor());
        $this->assertNull($this->icon->getAnchor());
    }

    public function testOrigin()
    {
        $this->icon->setOrigin($point = $this->createPointMock());

        $this->assertSame($point, $this->icon->getOrigin());
    }

    public function testResetOrigin()
    {
        $this->icon->setOrigin($this->createPointMock());
        $this->icon->setOrigin(null);

        $this->assertFalse($this->icon->hasOrigin());
        $this->assertNull($this->icon->getOrigin());
    }

    public function testScaledSize()
    {
        $this->icon->setScaledSize($size = $this->createSizeMock());

        $this->assertSame($size, $this->icon->getScaledSize());
    }

    public function testResetScaledSize()
    {
        $this->icon->setScaledSize($this->createSizeMock());
        $this->icon->setScaledSize(null);

        $this->assertFalse($this->icon->hasScaledSize());
        $this->assertNull($this->icon->getScaledSize());
    }

    public function testSize()
    {
        $this->icon->setSize($size = $this->createSizeMock());

        $this->assertSame($size, $this->icon->getSize());
    }

    public function testResetSize()
    {
        $this->icon->setSize($this->createSizeMock());
        $this->icon->setSize(null);

        $this->assertFalse($this->icon->hasSize());
        $this->assertNull($this->icon->getSize());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Point
     */
    private function createPointMock()
    {
        return $this->createMock(Point::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Size
     */
    private function createSizeMock()
    {
        return $this->createMock(Size::class);
    }
}
