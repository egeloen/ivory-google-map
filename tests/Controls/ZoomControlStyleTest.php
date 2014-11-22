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

use Ivory\GoogleMap\Controls\ZoomControlStyle;

/**
 * Zoom control style test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Controls\ZoomControlStyle');
    }

    public function testConstants()
    {
        $this->assertSame('default', ZoomControlStyle::DEFAULT_);
        $this->assertSame('large', ZoomControlStyle::LARGE);
        $this->assertSame('small', ZoomControlStyle::SMALL);
    }
}
