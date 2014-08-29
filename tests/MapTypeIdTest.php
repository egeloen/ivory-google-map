<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap;

use Ivory\GoogleMap\MapTypeId;

/**
 * Map type ID test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdTest extends \PHPUnit_Framework_TestCase
{
    public function testMapTypeIds()
    {
        $expected = array(
            MapTypeId::HYBRID,
            MapTypeId::ROADMAP,
            MapTypeId::SATELLITE,
            MapTypeId::TERRAIN
        );

        $this->assertSame($expected, MapTypeId::getMapTypeIds());
    }
}
