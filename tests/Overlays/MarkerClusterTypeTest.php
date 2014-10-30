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

use Ivory\GoogleMap\Overlays\MarkerClusterType;

/**
 * Marker cluster type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterTypeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Overlays\MarkerClusterType');
    }

    public function testConstants()
    {
        $this->assertSame('default', MarkerClusterType::DEFAULT_);
        $this->assertSame('marker_cluster', MarkerClusterType::MARKER_CLUSTER);
    }
}
