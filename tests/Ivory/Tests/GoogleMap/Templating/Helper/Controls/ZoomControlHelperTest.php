<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Controls;

use Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\ZoomControl,
    Ivory\GoogleMap\Controls\ZoomControlStyle,
    Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper;

/**
 * Zoom control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper */
    protected $zoomControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlHelper = new ZoomControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->zoomControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlStyleHelper',
            $this->zoomControlHelper->getZoomControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');
        $zoomControlStyleHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlStyleHelper');

        $this->zoomControlHelper = new ZoomControlHelper($controlPositionHelper, $zoomControlStyleHelper);

        $this->assertSame($controlPositionHelper, $this->zoomControlHelper->getControlPositionHelper());
        $this->assertSame($zoomControlStyleHelper, $this->zoomControlHelper->getZoomControlStyleHelper());
    }

    public function testRender()
    {
        $zoomControlTest = new ZoomControl(ControlPosition::BOTTOM_CENTER, ZoomControlStyle::SMALL);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ZoomControlStyle.SMALL}',
            $this->zoomControlHelper->render($zoomControlTest)
        );
    }
}
