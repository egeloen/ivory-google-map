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

use Ivory\GoogleMap\Controls\ScaleControlStyle;

/**
 * Scale control style test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Controls\ScaleControlStyle');
    }

    public function testConstants()
    {
        $this->assertSame('default', ScaleControlStyle::DEFAULT_);
    }
}
