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

use Ivory\GoogleMap\Overlays\MarkerShapeType;

/**
 * Marker shape type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTypeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Overlays\MarkerShapeType');
    }

    public function testConstants()
    {
        $this->assertSame('circle', MarkerShapeType::CIRCLE);
        $this->assertSame('poly', MarkerShapeType::POLYGON);
        $this->assertSame('rect', MarkerShapeType::RECTANGLE);
    }
}
