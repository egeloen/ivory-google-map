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
    Ivory\GoogleMap\Controls\RotateControl,
    Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper;

/**
 * Rotate control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper */
    protected $rotateControlHelper;

    /**p
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlHelper = new RotateControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper',
            $this->rotateControlHelper->getControlPositionHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ControlPositionHelper');

        $this->rotateControlHelper = new RotateControlHelper($controlPositionHelper);

        $this->assertSame($controlPositionHelper, $this->rotateControlHelper->getControlPositionHelper());
    }

    public function testRender()
    {
        $rotateControl = new RotateControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->rotateControlHelper->render($rotateControl)
        );
    }
}
