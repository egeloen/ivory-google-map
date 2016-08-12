<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\EncodedPolylineCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolylineCollector
     */
    private $encodedPolylineCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineCollector = new EncodedPolylineCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addEncodedPolyline($encodedPolyline = new EncodedPolyline('value'));

        $this->assertSame([$encodedPolyline], $this->encodedPolylineCollector->collect($map));
    }
}
