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
    Ivory\GoogleMap\Controls\StreetViewControl,
    Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper;

/**
 * Street view control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper */
    protected $streetViewControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControlHelper = new StreetViewControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->streetViewControlHelper->getControlPositionHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');

        $this->streetViewControlHelper = new StreetViewControlHelper($controlPositionHelper);

        $this->assertSame($controlPositionHelper, $this->streetViewControlHelper->getControlPositionHelper());
    }

    public function testRender()
    {
        $streetViewControl = new StreetViewControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->streetViewControlHelper->render($streetViewControl)
        );
    }
}
