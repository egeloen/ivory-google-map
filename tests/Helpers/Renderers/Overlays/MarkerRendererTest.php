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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Icon;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Marker renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer */
    private $markerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerRenderer = new MarkerRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->markerRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->markerRenderer->getJsonBuilder());
        $this->assertAnimationRendererInstance($this->markerRenderer->getAnimationRenderer());
    }

    public function testInitialState()
    {
        $this->markerRenderer = new MarkerRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $animationRenderer = $this->createAnimationRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->markerRenderer->getJsonBuilder());
        $this->assertSame($animationRenderer, $this->markerRenderer->getAnimationRenderer());
    }

    public function testSetAnimationRenderer()
    {
        $this->markerRenderer->setAnimationRenderer($animationRenderer = $this->createAnimationRendererMock());

        $this->assertSame($animationRenderer, $this->markerRenderer->getAnimationRenderer());
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Marker $marker, Map $map = null)
    {
        $this->assertSame($expected, $this->markerRenderer->render($marker, $map));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('new google.maps.Marker({"position":coordinate})', $this->createMarkerMock()),
            array(
                'new google.maps.Marker({"position":coordinate,"map":map})',
                $this->createMarkerMock(),
                $this->createMapMock(),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"animation":google.maps.Animation.BOUNCE})',
                $this->createMarkerMock(Animation::BOUNCE),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"icon":icon})',
                $this->createMarkerMock(null, $this->createIconMock()),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"shadow":shadow})',
                $this->createMarkerMock(null, null, $this->createIconMock('shadow')),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"shape":marker_shape})',
                $this->createMarkerMock(null, null, null, $this->createMarkerShapeMock()),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"foo":"bar"})',
                $this->createMarkerMock(null, null, null, null, array('foo' => 'bar')),
            ),
            array(
                'new google.maps.Marker({"position":coordinate,"animation":google.maps.Animation.BOUNCE,"icon":icon,"shadow":shadow,"shape":marker_shape,"foo":"bar"})',
                $this->createMarkerMock(
                    Animation::BOUNCE,
                    $this->createIconMock(),
                    $this->createIconMock('shadow'),
                    $this->createMarkerShapeMock(),
                    array('foo' => 'bar')
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createCoordinateMock()
    {
        $coordinate = parent::createCoordinateMock();
        $coordinate
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('coordinate'));

        return $coordinate;
    }

    /**
     * Creates an icon mock.
     *
     * @param string $variable The variable.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|\PHPUnit_Framework_MockObject_MockObject The icon mock.
     */
    protected function createIconMock($variable = 'icon')
    {
        $icon = parent::createIconMock();
        $icon
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $icon;
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
     * Creates a marker mock.
     *
     * @param string|null                                $animation   The animation.
     * @param \Ivory\GoogleMap\Overlays\Icon|null        $icon        The icon.
     * @param \Ivory\GoogleMap\Overlays\Icon|null        $shadow      The shadow.
     * @param \Ivory\GoogleMap\Overlays\MarkerShape|null $markerShape The marker shape.
     * @param array                                      $options     The options.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(
        $animation = null,
        Icon $icon = null,
        Icon $shadow = null,
        MarkerShape $markerShape = null,
        array $options = array()
    ) {
        $marker = parent::createMarkerMock();
        $marker
            ->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue($this->createCoordinateMock()));

        if ($animation !== null) {
            $marker
                ->expects($this->any())
                ->method('hasAnimation')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getAnimation')
                ->will($this->returnValue($animation));
        }

        if ($icon !== null) {
            $marker
                ->expects($this->any())
                ->method('hasIcon')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getIcon')
                ->will($this->returnValue($icon));
        }

        if ($shadow !== null) {
            $marker
                ->expects($this->any())
                ->method('hasShadow')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getShadow')
                ->will($this->returnValue($shadow));
        }

        if ($markerShape !== null) {
            $marker
                ->expects($this->any())
                ->method('hasShape')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getShape')
                ->will($this->returnValue($markerShape));
        }

        $marker
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue($options));

        return $marker;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMarkerShapeMock()
    {
        $markerShape = parent::createMarkerShapeMock();
        $markerShape
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('marker_shape'));

        return $markerShape;
    }
}
