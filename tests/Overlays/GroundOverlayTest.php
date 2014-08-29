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

use Ivory\GoogleMap\Overlays\GroundOverlay;

/**
 * Ground overlay test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayTest extends \PHPUnit_Framework_TestCase
{
    /** @vra \Ivory\GoogleMap\Overlays\GroundOverlay */
    protected $groundOverlay;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlay = new GroundOverlay();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlay);
    }

    public function testDefaultState()
    {
        $this->assertSame(-1, $this->groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $this->groundOverlay->getBound()->getSouthWest()->getLongitude());

        $this->assertSame(1, $this->groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $this->groundOverlay->getBound()->getNorthEast()->getLongitude());

        $this->assertNull($this->groundOverlay->getUrl());
    }

    public function testInitialState()
    {
        $url = 'foo';

        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->groundOverlay = new GroundOverlay($url, $bound);

        $this->assertSame($url, $this->groundOverlay->getUrl());
        $this->assertSame($bound, $this->groundOverlay->getBound());
    }

    public function testUrlWithValidValue()
    {
        $this->groundOverlay->setUrl('foo');

        $this->assertSame('foo', $this->groundOverlay->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The url of a ground overlay must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->groundOverlay->setUrl(true);
    }

    public function testBoundWithValidBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->any())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->groundOverlay->setBound($bound);

        $this->assertSame($bound, $this->groundOverlay->getBound());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A ground overlay bound must have a south west & a north east coordinate.
     */
    public function testBoundWithInvalidBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->any())
            ->method('hasCoordinates')
            ->will($this->returnValue(false));

        $this->groundOverlay->setBound($bound);
    }

    public function testBoundWithSouthWestAndNorthEast()
    {
        $southWest = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEast = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->groundOverlay->setBound($southWest, $northEast);

        $this->assertSame($southWest, $this->groundOverlay->getBound()->getSouthWest());
        $this->assertSame($northEast, $this->groundOverlay->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $this->groundOverlay->setBound(-1, -2, 1, 2, true, false);

        $this->assertSame(-1, $this->groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-2, $this->groundOverlay->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->groundOverlay->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(1, $this->groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(2, $this->groundOverlay->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->groundOverlay->getBound()->getNorthEast()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     */
    public function testBoundWithInvalidValue()
    {
        $this->groundOverlay->setBound('foo');
    }
}
