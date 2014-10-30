<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Coordinate renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer */
    private $coordinateRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateRenderer = new CoordinateRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinateRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Coordinate $coordinate)
    {
        $this->assertSame($expected, $this->coordinateRenderer->render($coordinate));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        $wrapCoordinate = $this->createCoordinateMock(false);
        $noWrapCoordinate = $this->createCoordinateMock(true);

        return array(
            array('new google.maps.LatLng(1.234,5.678,false)', $wrapCoordinate),
            array('new google.maps.LatLng(1.234,5.678,true)', $noWrapCoordinate),
        );
    }

    /**
     * Creates a coordinate mock.
     *
     * @param boolean $noWrap The no wrap.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject The coordinate mock.
     */
    protected function createCoordinateMock($noWrap = true)
    {
        $coordinate = parent::createCoordinateMock();
        $coordinate
            ->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue(1.234));

        $coordinate
            ->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue(5.678));

        $coordinate
            ->expects($this->any())
            ->method('isNoWrap')
            ->will($this->returnValue($noWrap));

        return $coordinate;
    }
}
