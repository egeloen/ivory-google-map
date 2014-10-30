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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer;
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Polyline renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer */
    private $polylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineRenderer = new PolylineRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polylineRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->polylineRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Polyline $polyline)
    {
        $this->assertSame(
            $expected,
            $this->polylineRenderer->render($polyline, $this->createMapMock())
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
                'new google.maps.Polyline({"map":map,"path":[coordinate1,coordinate2]})',
                $this->createPolylineMock(array(
                    $this->createCoordinateMock('coordinate1'),
                    $this->createCoordinateMock('coordinate2'),
                )),
            ),
            array(
                'new google.maps.Polyline({"map":map,"path":[coordinate],"foo":"bar"})',
                $this->createPolylineMock(array($this->createCoordinateMock()), array('foo' => 'bar')),
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
     * Creates a polyline mock.
     *
     * @param array $coordinates The coordinates.
     * @param array $options     The options.
     *
     * @return \Ivory\GoogleMap\Overlays\Polyline|\PHPUnit_Framework_MockObject_MockObject The polyline mock.
     */
    protected function createPolylineMock(array $coordinates = array(), array $options = array())
    {
        $polyline = parent::createPolylineMock();
        $polyline
            ->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue($coordinates));

        $polyline
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue($options));

        return $polyline;
    }
}
