<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Layers;

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Layers test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a kml layer instance.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     */
    protected function assertKmlLayerInstance($kmlLayer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Layers\KmlLayer', $kmlLayer);
    }
}
