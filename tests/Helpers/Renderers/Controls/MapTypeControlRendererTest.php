<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer;
use Ivory\GoogleMap\MapTypeId;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Map type control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer */
    private $mapTypeControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlRenderer = new MapTypeControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlStyleRenderer);
        unset($this->controlPositionRenderer);
        unset($this->mapTypeIdRenderer);
        unset($this->jsonBuilder);
        unset($this->mapTypeControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->mapTypeControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->mapTypeControlRenderer->getJsonBuilder());
        $this->assertMapTypeIdRendererInstance($this->mapTypeControlRenderer->getMapTypeIdRenderer());
        $this->assertControlPositionRendererInstance($this->mapTypeControlRenderer->getControlPositionRenderer());

        $this->assertMapTypeControlStyleRendererInstance(
            $this->mapTypeControlRenderer->getMapTypeControlStyleRenderer()
        );
    }

    public function testInitialState()
    {
        $this->mapTypeControlRenderer = new MapTypeControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $mapTypeIdRenderer = $this->createMapTypeIdRendererMock(),
            $controlPositionRenderer = $this->createControlPositionRendererMock(),
            $mapTypeControlStyleRenderer = $this->createMapTypeControlStyleRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->mapTypeControlRenderer->getJsonBuilder());
        $this->assertSame($mapTypeIdRenderer, $this->mapTypeControlRenderer->getMapTypeIdRenderer());
        $this->assertSame($controlPositionRenderer, $this->mapTypeControlRenderer->getControlPositionRenderer());

        $this->assertSame(
            $mapTypeControlStyleRenderer,
            $this->mapTypeControlRenderer->getMapTypeControlStyleRenderer()
        );
    }

    public function testSetMapTypeIdRenderer()
    {
        $this->mapTypeControlRenderer->setMapTypeIdRenderer($mapTypeIdRenderer = $this->createMapTypeIdRendererMock());

        $this->assertSame($mapTypeIdRenderer, $this->mapTypeControlRenderer->getMapTypeIdRenderer());
    }

    public function testSetControlPositionRenderer()
    {
        $this->mapTypeControlRenderer->setControlPositionRenderer(
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($controlPositionRenderer, $this->mapTypeControlRenderer->getControlPositionRenderer());
    }

    public function testSetMapTypeControlStyleRenderer()
    {
        $this->mapTypeControlRenderer->setMapTypeControlStyleRenderer(
            $mapTypeControlStyleRenderer = $this->createMapTypeControlStyleRendererMock()
        );

        $this->assertSame(
            $mapTypeControlStyleRenderer,
            $this->mapTypeControlRenderer->getMapTypeControlStyleRenderer()
        );
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, MapTypeControl $mapTypeControl)
    {
        $this->assertSame($expected, $this->mapTypeControlRenderer->render($mapTypeControl));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        $emptyMapTypeControl = $this->createMapTypeControlMock();
        $fullMapTypeControl = $this->createMapTypeControlMock(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE));

        return array(
            array(
                '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.MapTypeControlStyle.DEFAULT}',
                $emptyMapTypeControl,
            ),
            array(
                '{"mapTypeIds":[google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.SATELLITE],"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.MapTypeControlStyle.DEFAULT}',
                $fullMapTypeControl,
            ),
        );
    }

    /**
     * Creates a map type control mock.
     *
     * @param array $mapTypeIds The map type ids.
     *
     * @return \Ivory\GoogleMap\Controls\MapTypeControl|\PHPUnit_Framework_MockObject_MockObject The map type control mock.
     */
    protected function createMapTypeControlMock(array $mapTypeIds = array())
    {
        $mapTypeControl = parent::createMapTypeControlMock();
        $mapTypeControl
            ->expects($this->any())
            ->method('getMapTypeIds')
            ->will($this->returnValue($mapTypeIds));

        $mapTypeControl
            ->expects($this->any())
            ->method('getControlPosition')
            ->will($this->returnValue(ControlPosition::BOTTOM_CENTER));

        $mapTypeControl
            ->expects($this->any())
            ->method('getMapTypeControlStyle')
            ->will($this->returnValue(MapTypeControlStyle::DEFAULT_));

        return $mapTypeControl;
    }
}
