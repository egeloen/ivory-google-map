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
 * Map type id test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\MapTypeId');
    }

    public function testConstants()
    {
        $this->assertSame('hybrid', MapTypeId::HYBRID);
        $this->assertSame('roadmap', MapTypeId::ROADMAP);
        $this->assertSame('satellite', MapTypeId::SATELLITE);
        $this->assertSame('terrain', MapTypeId::TERRAIN);
    }
}
