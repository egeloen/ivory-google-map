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

use Ivory\GoogleMap\Helper\Collector\Overlay\DefaultInfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultInfoWindowCollector
     */
    private $defaultInfoWindowCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->defaultInfoWindowCollector = new DefaultInfoWindowCollector(new MarkerCollector());
    }

    public function testCollect()
    {
        $defaultInfoWindow = new InfoWindow('content', InfoWindowType::DEFAULT_);
        $infoBox = new InfoWindow('content', InfoWindowType::INFO_BOX);

        $map = new Map();
        $map->getOverlayManager()->addInfoWindows([$defaultInfoWindow, $infoBox]);

        $this->assertSame([$defaultInfoWindow], $this->defaultInfoWindowCollector->collect($map));
    }
}
