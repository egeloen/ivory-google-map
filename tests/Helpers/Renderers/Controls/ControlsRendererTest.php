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

use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\OverviewMapControl;
use Ivory\GoogleMap\Controls\PanControl;
use Ivory\GoogleMap\Controls\RotateControl;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\StreetViewControl;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Controls renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlsRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer */
    private $controlsRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer */
    private $mapTypeControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer */
    private $overviewMapControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer */
    private $panControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer */
    private $rotateControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer */
    private $scaleControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer */
    private $streetViewControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer */
    private $zoomControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlsRenderer = new ControlsRenderer(
            $this->mapTypeControlRenderer = $this->createMapTypeControlRendererMock(),
            $this->overviewMapControlRenderer = $this->createOverviewMapControlRendererMock(),
            $this->panControlRenderer = $this->createPanControlRendererMock(),
            $this->rotateControlRenderer = $this->createRotateControlRendererMock(),
            $this->scaleControlRenderer = $this->createScaleControlRendererMock(),
            $this->streetViewControlRenderer = $this->createStreetViewControlRendererMock(),
            $this->zoomControlRenderer = $this->createZoomControlRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->controlsRenderer);
    }

    public function testDefaultState()
    {
        $this->controlsRenderer = new ControlsRenderer();

        $this->assertMapTypeControlRendererInstance($this->controlsRenderer->getMapTypeControlRenderer());
        $this->assertOverviewMapControlRendererInstance($this->controlsRenderer->getOverviewMapControlRenderer());
        $this->assertPanControlRendererInstance($this->controlsRenderer->getPanControlRenderer());
        $this->assertRotateControlRendererInstance($this->controlsRenderer->getRotateControlRenderer());
        $this->assertScaleControlRendererInstance($this->controlsRenderer->getScaleControlRenderer());
        $this->assertStreetViewControlRendererInstance($this->controlsRenderer->getStreetViewControlRenderer());
        $this->assertZoomControlRendererInstance($this->controlsRenderer->getZoomControlRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->mapTypeControlRenderer, $this->controlsRenderer->getMapTypeControlRenderer());
        $this->assertSame($this->overviewMapControlRenderer, $this->controlsRenderer->getOverviewMapControlRenderer());
        $this->assertSame($this->panControlRenderer, $this->controlsRenderer->getPanControlRenderer());
        $this->assertSame($this->rotateControlRenderer, $this->controlsRenderer->getRotateControlRenderer());
        $this->assertSame($this->scaleControlRenderer, $this->controlsRenderer->getScaleControlRenderer());
        $this->assertSame($this->streetViewControlRenderer, $this->controlsRenderer->getStreetViewControlRenderer());
        $this->assertSame($this->zoomControlRenderer, $this->controlsRenderer->getZoomControlRenderer());
    }

    public function testSetMapTypeControlRenderer()
    {
        $this->controlsRenderer->setMapTypeControlRenderer(
            $mapTypeControlRenderer = $this->createMapTypeControlRendererMock()
        );

        $this->assertSame($mapTypeControlRenderer, $this->controlsRenderer->getMapTypeControlRenderer());
    }

    public function testSetOverviewMapControlRenderer()
    {
        $this->controlsRenderer->setOverviewMapControlRenderer(
            $overviewMapControlRenderer = $this->createOverviewMapControlRendererMock()
        );

        $this->assertSame($overviewMapControlRenderer, $this->controlsRenderer->getOverviewMapControlRenderer());
    }

    public function testSetPanControlRenderer()
    {
        $this->controlsRenderer->setPanControlRenderer($panControlRenderer = $this->createPanControlRendererMock());

        $this->assertSame($panControlRenderer, $this->controlsRenderer->getPanControlRenderer());
    }

    public function testSetRotateControlRenderer()
    {
        $this->controlsRenderer->setRotateControlRenderer(
            $rotateControlRenderer = $this->createRotateControlRendererMock()
        );

        $this->assertSame($rotateControlRenderer, $this->controlsRenderer->getRotateControlRenderer());
    }

    public function testSetScaleControlRenderer()
    {
        $this->controlsRenderer->setScaleControlRenderer(
            $scaleControlRenderer = $this->createScaleControlRendererMock()
        );

        $this->assertSame($scaleControlRenderer, $this->controlsRenderer->getScaleControlRenderer());
    }

    public function testSetStreetViewControlRenderer()
    {
        $this->controlsRenderer->setStreetViewControlRenderer(
            $streetViewControlRenderer = $this->createStreetViewControlRendererMock()
        );

        $this->assertSame($streetViewControlRenderer, $this->controlsRenderer->getStreetViewControlRenderer());
    }

    public function testSetZoomControlRenderer()
    {
        $this->controlsRenderer->setZoomControlRenderer($zoomControlRenderer = $this->createZoomControlRendererMock());

        $this->assertSame($zoomControlRenderer, $this->controlsRenderer->getZoomControlRenderer());
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender(
        array $expected,
        array $options = array(),
        MapTypeControl $mapTypeControl = null,
        OverviewMapControl $overviewMapControl = null,
        PanControl $panControl = null,
        RotateControl $rotateControl = null,
        ScaleControl $scaleControl = null,
        StreetViewControl $streetViewControl = null,
        ZoomControl $zoomControl = null
    ) {
        $map = $this->createMapMock(
            $options,
            $mapTypeControl,
            $overviewMapControl,
            $panControl,
            $rotateControl,
            $scaleControl,
            $streetViewControl,
            $zoomControl
        );

        $jsonBuilder = $this->createJsonBuilderMock();
        $jsonBuilder
            ->expects($this->exactly(count($expected)))
            ->method('setValue')
            ->will($this->returnValueMap($expected));

        $this->controlsRenderer->render($map, $jsonBuilder);
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        $mapTypeControl = $this->createMapTypeControlMock();
        $overviewMapControl = $this->createOverviewMapControlMock();
        $panControl = $this->createPanControlMock();
        $rotateControl = $this->createRotateControlMock();
        $scaleControl = $this->createScaleControlMock();
        $streetViewControl = $this->createStreetViewControlMock();
        $zoomControl = $this->createZoomControlMock();

        return array(
            array(array()),
            array(array(array('[mapTypeControl]', true, true)), array('mapTypeControl' => true)),
            array(array(array('[mapTypeControl]', false, true)), array('mapTypeControl' => false)),
            array(array(array('[overviewMapControl]', true, true)), array('overviewMapControl' => true)),
            array(array(array('[overviewMapControl]', false, true)), array('overviewMapControl' => false)),
            array(array(array('[panControl]', true, true)), array('panControl' => true)),
            array(array(array('[panControl]', false, true)), array('panControl' => false)),
            array(array(array('[rotateControl]', true, true)), array('rotateControl' => true)),
            array(array(array('[rotateControl]', false, true)), array('rotateControl' => false)),
            array(array(array('[scaleControl]', true, true)), array('scaleControl' => true)),
            array(array(array('[scaleControl]', false, true)), array('scaleControl' => false)),
            array(array(array('[streetViewControl]', true, true)), array('streetViewControl' => true)),
            array(array(array('[streetViewControl]', false, true)), array('streetViewControl' => false)),
            array(array(array('[zoomControl]', true, true)), array('zoomControl' => true)),
            array(array(array('[zoomControl]', false, true)), array('zoomControl' => false)),
            array(
                array(
                    array('[mapTypeControl]', true, true),
                    array('[overviewMapControl]', true, true),
                    array('[panControl]', true, true),
                    array('[rotateControl]', true, true),
                    array('[scaleControl]', true, true),
                    array('[streetViewControl]', true, true),
                    array('[zoomControl]', true, true),
                ),
                array(
                    'mapTypeControl'     => true,
                    'overviewMapControl' => true,
                    'panControl'         => true,
                    'rotateControl'      => true,
                    'scaleControl'       => true,
                    'streetViewControl'  => true,
                    'zoomControl'        => true,
                ),
            ),
            array(
                array(
                    array('[mapTypeControl]', false, true),
                    array('[overviewMapControl]', false, true),
                    array('[panControl]', false, true),
                    array('[rotateControl]', false, true),
                    array('[scaleControl]', false, true),
                    array('[streetViewControl]', false, true),
                    array('[zoomControl]', false, true),
                ),
                array(
                    'mapTypeControl'     => false,
                    'overviewMapControl' => false,
                    'panControl'         => false,
                    'rotateControl'      => false,
                    'scaleControl'       => false,
                    'streetViewControl'  => false,
                    'zoomControl'        => false,
                ),
            ),
            array(
                array(
                    array('[mapTypeControl]', true, true),
                    array('[mapTypeControlOptions]', 'map_type_control_options', true),
                ),
                array(),
                $mapTypeControl,
            ),
            array(
                array(
                    array('[overviewMapControl]', true, true),
                    array('[overviewMapControlOptions]', 'overview_map_control_options', true),
                ),
                array(),
                null,
                $overviewMapControl,
            ),
            array(
                array(
                    array('[panControl]', true, true),
                    array('[panControlOptions]', 'pan_control_options', true),
                ),
                array(),
                null,
                null,
                $panControl,
            ),
            array(
                array(
                    array('[rotateControl]', true, true),
                    array('[rotateControlOptions]', 'rotate_control_options', true),
                ),
                array(),
                null,
                null,
                null,
                $rotateControl,
            ),
            array(
                array(
                    array('[scaleControl]', true, true),
                    array('[scaleControlOptions]', 'scale_control_options', true),
                ),
                array(),
                null,
                null,
                null,
                null,
                $scaleControl,
            ),
            array(
                array(
                    array('[streetViewControl]', true, true),
                    array('[streetViewControlOptions]', 'street_view_control_options', true),
                ),
                array(),
                null,
                null,
                null,
                null,
                null,
                $streetViewControl,
            ),
            array(
                array(
                    array('[zoomControl]', true, true),
                    array('[zoomControlOptions]', 'zoom_control_options', true),
                ),
                array(),
                null,
                null,
                null,
                null,
                null,
                null,
                $zoomControl,
            ),
        );
    }

    /**
     * Creates a controls mock.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl|null     $mapTypeControl     The map type control.
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl|null $overviewMapControl The overview map control.
     * @param \Ivory\GoogleMap\Controls\PanControl|null         $panControl         The pan control.
     * @param \Ivory\GoogleMap\Controls\RotateControl|null      $rotateControl      The rotate control.
     * @param \Ivory\GoogleMap\Controls\ScaleControl|null       $scaleControl       The scale control.
     * @param \Ivory\GoogleMap\Controls\StreetViewControl|null  $streetViewControl  The street view control.
     * @param \Ivory\GoogleMap\Controls\ZoomControl|null        $zoomControl        The zoom control.
     *
     * @return \Ivory\GoogleMap\Controls\Controls|\PHPUnit_Framework_MockObject_MockObject The controls mock.
     */
    protected function createControlsMock(
        MapTypeControl $mapTypeControl = null,
        OverviewMapControl $overviewMapControl = null,
        PanControl $panControl = null,
        RotateControl $rotateControl = null,
        ScaleControl $scaleControl = null,
        StreetViewControl $streetViewControl = null,
        ZoomControl $zoomControl = null
    ) {
        $controls = parent::createControlsMock();

        if ($mapTypeControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasMapTypeControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getMapTypeControl')
                ->will($this->returnValue($mapTypeControl));
        }

        if ($overviewMapControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasOverviewMapControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getOverviewMapControl')
                ->will($this->returnValue($overviewMapControl));
        }

        if ($panControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasPanControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getPanControl')
                ->will($this->returnValue($panControl));
        }

        if ($rotateControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasRotateControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getRotateControl')
                ->will($this->returnValue($rotateControl));
        }

        if ($scaleControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasScaleControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getScaleControl')
                ->will($this->returnValue($scaleControl));
        }

        if ($streetViewControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasStreetViewControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getStreetViewControl')
                ->will($this->returnValue($streetViewControl));
        }

        if ($zoomControl !== null) {
            $controls
                ->expects($this->any())
                ->method('hasZoomControl')
                ->will($this->returnValue(true));

            $controls
                ->expects($this->any())
                ->method('getZoomControl')
                ->will($this->returnValue($zoomControl));
        }

        return $controls;
    }

    /**
     * Creates a map mock.
     *
     * @param array                                             $options            The options.
     * @param \Ivory\GoogleMap\Controls\MapTypeControl|null     $mapTypeControl     The map type control.
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl|null $overviewMapControl The overview map control.
     * @param \Ivory\GoogleMap\Controls\PanControl|null         $panControl         The pan control.
     * @param \Ivory\GoogleMap\Controls\RotateControl|null      $rotateControl      The rotate control.
     * @param \Ivory\GoogleMap\Controls\ScaleControl|null       $scaleControl       The scale control.
     * @param \Ivory\GoogleMap\Controls\StreetViewControl|null  $streetViewControl  The street view control.
     * @param \Ivory\GoogleMap\Controls\ZoomControl|null        $zoomControl        The zoom control.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(
        array $options = array(),
        MapTypeControl $mapTypeControl = null,
        OverviewMapControl $overviewMapControl = null,
        PanControl $panControl = null,
        RotateControl $rotateControl = null,
        ScaleControl $scaleControl = null,
        StreetViewControl $streetViewControl = null,
        ZoomControl $zoomControl = null
    ) {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getControls')
            ->will($this->returnValue($this->createControlsMock(
                $mapTypeControl,
                $overviewMapControl,
                $panControl,
                $rotateControl,
                $scaleControl,
                $streetViewControl,
                $zoomControl
            )));

        $map
            ->expects($this->any())
            ->method('hasMapOption')
            ->will($this->returnCallback(function ($name) use ($options) {
                return isset($options[$name]);
            }));

        $map
            ->expects($this->any())
            ->method('getMapOption')
            ->will($this->returnCallback(function ($name) use ($options) {
                return $options[$name];
            }));

        return $map;
    }
}
