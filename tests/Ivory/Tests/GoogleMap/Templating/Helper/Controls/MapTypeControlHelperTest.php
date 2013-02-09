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
    Ivory\GoogleMap\Controls\MapTypeControl,
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\MapTypeId,
    Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper;

/**
 * Map type control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper */
    protected $mapTypeControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlHelper = new MapTypeControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper',
            $this->mapTypeControlHelper->getMapTypeIdHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->mapTypeControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlStyleHelper',
            $this->mapTypeControlHelper->getMapTypeControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $mapTypeIdHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper');
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');
        $mapTypeControlStyleHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlStyleHelper');

        $this->mapTypeControlHelper = new MapTypeControlHelper(
            $mapTypeIdHelper,
            $controlPositionHelper,
            $mapTypeControlStyleHelper
        );

        $this->assertSame($mapTypeIdHelper, $this->mapTypeControlHelper->getMapTypeIdHelper());
        $this->assertSame($controlPositionHelper, $this->mapTypeControlHelper->getControlPositionHelper());
        $this->assertSame($mapTypeControlStyleHelper, $this->mapTypeControlHelper->getMapTypeControlStyleHelper());
    }

    public function testRender()
    {
        $mapTypeControl = new MapTypeControl(
            array(MapTypeId::ROADMAP),
            ControlPosition::BOTTOM_CENTER,
            MapTypeControlStyle::DROPDOWN_MENU
        );

        $this->assertSame(
            '{"mapTypeIds":[google.maps.MapTypeId.ROADMAP],"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.MapTypeControlStyle.DROPDOWN_MENU}',
            $this->mapTypeControlHelper->render($mapTypeControl)
        );
    }
}
