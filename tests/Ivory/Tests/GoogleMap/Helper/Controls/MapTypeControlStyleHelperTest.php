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

use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Helper\Controls\MapTypeControlStyleHelper;

/**
 * Map type control style helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Controls\MapTypeControlStyleHelper */
    protected $mapTypeControlStyleHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlStyleHelper = new MapTypeControlStyleHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlStyleHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame(
            'google.maps.MapTypeControlStyle.DEFAULT',
            $this->mapTypeControlStyleHelper->render(MapTypeControlStyle::DEFAULT_)
        );

        $this->assertSame(
            'google.maps.MapTypeControlStyle.DROPDOWN_MENU',
            $this->mapTypeControlStyleHelper->render(MapTypeControlStyle::DROPDOWN_MENU)
        );

        $this->assertSame(
            'google.maps.MapTypeControlStyle.HORIZONTAL_BAR',
            $this->mapTypeControlStyleHelper->render(MapTypeControlStyle::HORIZONTAL_BAR)
        );
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The map type control style can only be : default, dropdown_menu, horizontal_bar.
     */
    public function testRenderWithInvalidValue()
    {
        $this->mapTypeControlStyleHelper->render('foo');
    }
}
