<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Helper\Controls\ScaleControlHelper;

/**
 * Scale control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ScaleControlHelper */
    protected $scaleControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlHelper = new ScaleControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->scaleControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\ScaleControlStyleHelper',
            $this->scaleControlHelper->getScaleControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\ControlPositionHelper');
        $scaleControlStyleHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\ScaleControlStyleHelper');

        $this->scaleControlHelper = new ScaleControlHelper($controlPositionHelper, $scaleControlStyleHelper);

        $this->assertSame($controlPositionHelper, $this->scaleControlHelper->getControlPositionHelper());
        $this->assertSame($scaleControlStyleHelper, $this->scaleControlHelper->getScaleControlStyleHelper());
    }

    public function testRender()
    {
        $scaleControl = new ScaleControl(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ScaleControlStyle.DEFAULT}',
            $this->scaleControlHelper->render($scaleControl)
        );
    }
}
