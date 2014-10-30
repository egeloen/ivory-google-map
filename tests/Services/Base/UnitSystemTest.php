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

use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\Tests\GoogleMap\Services\AbstractTestCase;

/**
 * Unit system test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class UnitSystemTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertTrue(is_subclass_of(
            'Ivory\GoogleMap\Services\Base\UnitSystem',
            'Ivory\GoogleMap\Assets\AbstractUninstantiableAsset'
        ));
    }

    public function testConstants()
    {
        $this->assertSame('IMPERIAL', UnitSystem::IMPERIAL);
        $this->assertSame('METRIC', UnitSystem::METRIC);
    }
}
