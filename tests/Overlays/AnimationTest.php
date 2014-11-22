<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Animation;

/**
 * Animation test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Overlays\Animation');
    }

    public function testConstants()
    {
        $this->assertSame('bounce', Animation::BOUNCE);
        $this->assertSame('drop', Animation::DROP);
    }
}
