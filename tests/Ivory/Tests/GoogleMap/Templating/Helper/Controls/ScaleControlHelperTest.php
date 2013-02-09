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
    Ivory\GoogleMap\Controls\ScaleControl,
    Ivory\GoogleMap\Controls\ScaleControlStyle,
    Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper;

/**
 * Scale control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper */
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
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->scaleControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlStyleHelper',
            $this->scaleControlHelper->getScaleControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');
        $scaleControlStyleHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlStyleHelper');

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
