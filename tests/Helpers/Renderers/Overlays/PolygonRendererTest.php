<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Polygon renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer */
    private $polygonRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygonRenderer = new PolygonRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygonRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->polygonRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Polygon $polygon)
    {
        $this->assertSame(
            $expected,
            $this->polygonRenderer->render($polygon, $this->createMapMock())
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array(
                'new google.maps.Polygon({"map":map,"paths":[coordinate1,coordinate2]})',
                $this->createPolygonMock(array(
                    $this->createCoordinateMock('coordinate1'),
                    $this->createCoordinateMock('coordinate2'),
                )),
            ),
            array(
                'new google.maps.Polygon({"map":map,"paths":[coordinate],"foo":"bar"})',
                $this->createPolygonMock(array($this->createCoordinateMock()), array('foo' => 'bar')),
            ),
        );
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

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        return $map;
    }

    /**
     * Creates a polygon mock.
     *
     * @param array $coordinates The coordinates.
     * @param array $options     The options.
     *
     * @return \Ivory\GoogleMap\Overlays\Polygon|\PHPUnit_Framework_MockObject_MockObject The polygon mock.
     */
    protected function createPolygonMock(array $coordinates = array(), array $options = array())
    {
        $polygon = parent::createPolygonMock();
        $polygon
            ->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue($coordinates));

        $polygon
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue($options));

        return $polygon;
    }
}
