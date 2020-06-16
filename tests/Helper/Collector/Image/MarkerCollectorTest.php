<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Image;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Image\MarkerCollector;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerStyleRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCollectorTest extends TestCase
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerCollector = new MarkerCollector(new MarkerStyleRenderer(new PointRenderer()));
    }

    public function testCollect()
    {
        $style = ['foo' => 'bar'];

        $marker1 = new Marker(new Coordinate());

        $marker2 = new Marker(new Coordinate());
        $marker2->setStaticOption('styles', $style);

        $marker3 = new Marker(new Coordinate());
        $marker3->setStaticOption('styles', $style);

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker1);
        $map->getOverlayManager()->addMarker($marker2);
        $map->getOverlayManager()->addMarker($marker3);

        $this->assertSame([[$marker1], [$marker2, $marker3]], $this->markerCollector->collect($map));
    }
}
