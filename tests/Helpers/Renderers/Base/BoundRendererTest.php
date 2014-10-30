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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Bound renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer */
    private $boundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundRenderer = new BoundRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Bound $bound)
    {
        $this->assertSame($expected, $this->boundRenderer->render($bound));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        $emptyBound = $this->createBoundMock();

        $coordinateBound = $this->createBoundMock();

        $coordinateBound
            ->expects($this->any())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $coordinateBound
            ->expects($this->any())
            ->method('getNorthEast')
            ->will($this->returnValue($this->createCoordinateMock('north_east')));

        $coordinateBound
            ->expects($this->any())
            ->method('getSouthWest')
            ->will($this->returnValue($this->createCoordinateMock('south_west')));

        return array(
            array('new google.maps.LatLngBounds()', $emptyBound),
            array('new google.maps.LatLngBounds(south_west,north_east)', $coordinateBound),
        );
    }

    /**
     * Creates a bound mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject The bound mock.
     */
    protected function createBoundMock($variable = 'bound')
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $bound;
    }

    /**
     * Creates a coordinate mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject The coordinate mock.
     */
    protected function createCoordinateMock($variable = 'coordinate')
    {
        $coordinate = parent::createCoordinateMock();
        $coordinate
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $coordinate;
    }
}
