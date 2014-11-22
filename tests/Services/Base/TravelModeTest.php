<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Base;

use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\Tests\GoogleMap\Services\AbstractTestCase;

/**
 * Travel mode test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelModeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertTrue(is_subclass_of(
            'Ivory\GoogleMap\Services\Base\TravelMode',
            'Ivory\GoogleMap\Assets\AbstractUninstantiableAsset'
        ));
    }

    public function testConstants()
    {
        $this->assertSame('BICYCLING', TravelMode::BICYCLING);
        $this->assertSame('DRIVING', TravelMode::DRIVING);
        $this->assertSame('WALKING', TravelMode::WALKING);
        $this->assertSame('TRANSIT', TravelMode::TRANSIT);
    }
}
