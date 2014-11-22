<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

use Ivory\GoogleMap\Helpers\Renderers\MapRenderer;

/**
 * Map renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapRenderer */
    private $mapRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapRenderer = new MapRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->mapRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->mapRenderer->getJsonBuilder());
        $this->assertMapTypeIdRendererInstance($this->mapRenderer->getMapTypeIdRenderer());
        $this->assertControlsRendererInstance($this->mapRenderer->getControlsRenderer());
    }

    public function testInitialState()
    {
        $this->mapRenderer = new MapRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $mapTypeIdRenderer = $this->createMapTypeIdRendererMock(),
            $controlsRenderer = $this->createControlsRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->mapRenderer->getJsonBuilder());
        $this->assertSame($mapTypeIdRenderer, $this->mapRenderer->getMapTypeIdRenderer());
        $this->assertSame($controlsRenderer, $this->mapRenderer->getControlsRenderer());
    }

    public function testSetMapTypeIdRenderer()
    {
        $this->mapRenderer->setMapTypeIdRenderer($mapTypeIdRenderer = $this->createMapTypeIdRendererMock());

        $this->assertSame($mapTypeIdRenderer, $this->mapRenderer->getMapTypeIdRenderer());
    }

    public function testSetControlsRenderer()
    {
        $this->mapRenderer->setControlsRenderer($controlsRenderer = $this->createControlsRendererMock());

        $this->assertSame($controlsRenderer, $this->mapRenderer->getControlsRenderer());
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, array $options = array(), $autoZoom = false)
    {
        $this->assertSame($expected, $this->mapRenderer->render($this->createMapMock($options, $autoZoom)));
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
                'new google.maps.Map(document.getElementById("id"),{"zoom":3,"mapTypeId":google.maps.MapTypeId.ROADMAP})',
            ),
            array(
                'new google.maps.Map(document.getElementById("id"),{"zoom":4,"mapTypeId":google.maps.MapTypeId.ROADMAP})',
                array('zoom' => 4),
            ),
            array(
                'new google.maps.Map(document.getElementById("id"),{"mapTypeId":google.maps.MapTypeId.ROADMAP})',
                array('zoom' => 4),
                true,
            ),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array   $options  The options.
     * @param boolean $autoZoom The auto zoom.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $options = array(), $autoZoom = false)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getHtmlContainerId')
            ->will($this->returnValue('id'));

        $map
            ->expects($this->any())
            ->method('getControls')
            ->will($this->returnValue($this->createControlsMock()));

        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($this->createOverlaysMock($autoZoom)));

        $map
            ->expects($this->any())
            ->method('getMapOptions')
            ->will($this->returnValue($options));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param boolean $autoZoom The auto zoom.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock($autoZoom = false)
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue($autoZoom));

        return $overlays;
    }
}
