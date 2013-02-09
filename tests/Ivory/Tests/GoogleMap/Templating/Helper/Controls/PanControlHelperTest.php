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
    Ivory\GoogleMap\Controls\PanControl,
    Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper;

/**
 * Overview map control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper */
    protected $panControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControlHelper = new PanControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->panControlHelper->getControlPositionHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');

        $this->panControlHelper = new PanControlHelper($controlPositionHelper);

        $this->assertSame($controlPositionHelper, $this->panControlHelper->getControlPositionHelper());
    }

    public function testRender()
    {
        $panControl = new PanControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->panControlHelper->render($panControl)
        );
    }
}
