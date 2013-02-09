<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\OverviewMapControl;

/**
 * Overview map control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Controls\OverviewMapControl */
    protected $overviewMapControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overviewMapControl = new OverviewMapControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overviewMapControl);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->overviewMapControl->isOpened());
    }

    public function testInitialState()
    {
        $this->overviewMapControl = new OverviewMapControl(true);

        $this->assertTrue($this->overviewMapControl->isOpened());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The opened property of an overview map control must be a boolean value.
     */
    public function testOpenedWithInvalidValue()
    {
        $this->overviewMapControl->setOpened('foo');
    }
}
