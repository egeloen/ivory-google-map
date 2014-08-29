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

use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\Helper\Controls\ZoomControlStyleHelper;

/**
 * Zoom control style helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ZoomControlStyleHelper */
    protected $zoomControlStyleHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlStyleHelper = new ZoomControlStyleHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlStyleHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame(
            'google.maps.ZoomControlStyle.DEFAULT',
            $this->zoomControlStyleHelper->render(ZoomControlStyle::DEFAULT_)
        );

        $this->assertSame(
            'google.maps.ZoomControlStyle.LARGE',
            $this->zoomControlStyleHelper->render(ZoomControlStyle::LARGE)
        );

        $this->assertSame(
            'google.maps.ZoomControlStyle.SMALL',
            $this->zoomControlStyleHelper->render(ZoomControlStyle::SMALL)
        );
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The zoom control style can only be : default, large, small.
     */
    public function testRenderWithInvalidValue()
    {
        $this->zoomControlStyleHelper->render('foo');
    }
}
