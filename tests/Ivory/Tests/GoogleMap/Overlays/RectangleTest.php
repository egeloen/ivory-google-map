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
class RectangleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Rectangle */
    protected $rectangle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangle = new Rectangle();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangle);
    }

    public function testDefaultState()
    {
        $this->assertSame(1, $this->rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $this->rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($this->rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1, $this->rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $this->rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->rectangle->getBound()->getSouthWest()->isNoWrap());
    }

    public function testInitialState()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->rectangle = new Rectangle($bound);

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    public function testBoundWithValidBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->rectangle->setBound($bound);

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A rectangle bound must have a south west & a north east coordinate.
     */
    public function testBoundWithInvalidBound()
    {
        $this->rectangle->setBound($this->getMock('Ivory\GoogleMap\Base\Bound'));
    }

    public function testBoundWithCoordinates()
    {
        $southWeestCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEastCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->rectangle->setBound($southWeestCoordinate, $northEastCoordinate);

        $this->assertSame($southWeestCoordinate, $this->rectangle->getBound()->getSouthWest());
        $this->assertSame($northEastCoordinate, $this->rectangle->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $southWestLatitude = 1;
        $southWestLongitue = 2;

        $northEastLatitude = -1;
        $northEastLongitude = -2;

        $this->rectangle->setBound(
            $southWestLatitude,
            $southWestLongitue,
            $northEastLatitude,
            $northEastLongitude,
            true,
            false
        );

        $this->assertSame($southWestLatitude, $this->rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame($southWestLongitue, $this->rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->rectangle->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame($northEastLatitude, $this->rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame($northEastLongitude, $this->rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->rectangle->getBound()->getNorthEast()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The bound setter arguments is invalid.
     * The available prototypes are :
     * - function setBound(Ivory\GoogleMap\Base\Bound $bound)
     * - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     * - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     */
    public function testBoundWithInvalidValue()
    {
        $this->rectangle->setBound('foo');
    }
}
