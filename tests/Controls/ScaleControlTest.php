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

use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

/**
 * Scale control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\ScaleControl */
    private $scaleControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControl = new ScaleControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getScaleControlStyle());
    }

    public function testInitialState()
    {
        $this->scaleControl = new ScaleControl($scaleControlStyle = ScaleControlStyle::DEFAULT_);

        $this->assertSame($scaleControlStyle, $this->scaleControl->getScaleControlStyle());
    }

    public function testSetScaleControlStyle()
    {
        $this->scaleControl->setScaleControlStyle($scaleControlStyle = ScaleControlStyle::DEFAULT_);

        $this->assertSame($scaleControlStyle, $this->scaleControl->getScaleControlStyle());
    }
}
