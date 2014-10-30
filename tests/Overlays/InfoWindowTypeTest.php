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

use Ivory\GoogleMap\Overlays\InfoWindowType;

/**
 * Info window type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowTypeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Overlays\InfoWindowType');
    }

    public function testConstants()
    {
        $this->assertSame('default', InfoWindowType::DEFAULT_);
        $this->assertSame('infobox', InfoWindowType::INFOBOX);
    }
}
