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

use Ivory\GoogleMap\Controls\MapTypeControlStyle;

/**
 * Map type control style test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleTest extends \PHPUnit_Framework_TestCase
{
    public function testMapTypeControlStyles()
    {
        $expected = array(
            MapTypeControlStyle::DEFAULT_,
            MapTypeControlStyle::DROPDOWN_MENU,
            MapTypeControlStyle::HORIZONTAL_BAR
        );

        $this->assertSame($expected, MapTypeControlStyle::getMapTypeControlStyles());
    }
}
