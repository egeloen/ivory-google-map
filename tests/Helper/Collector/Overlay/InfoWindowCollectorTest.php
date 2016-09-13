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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoWindowCollector
     */
    private $infoWindowCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowCollector = new InfoWindowCollector(new MarkerCollector());
    }

    public function testMarkerCollector()
    {
        $this->infoWindowCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->infoWindowCollector->getMarkerCollector());
    }

    public function testType()
    {
        $this->infoWindowCollector->setType($type = InfoWindowType::DEFAULT_);

        $this->assertSame($type, $this->infoWindowCollector->getType());
    }

    /**
     * @param InfoWindow[] $expected
     * @param Map          $map
     * @param int          $strategy
     * @param string|null  $type
     *
     * @dataProvider collectProvider
     */
    public function testCollect(array $expected, Map $map, $strategy, $type = null)
    {
        $this->infoWindowCollector->setType($type);

        $this->assertSame($expected, $this->infoWindowCollector->collect($map, [], $strategy));
    }

    /**
     * @return mixed[][]
     */
    public function collectProvider()
    {
        $infoWindow = new InfoWindow('content');
        $markerInfoWindow = new InfoWindow('content');

        $infoBox = new InfoWindow('content');
        $infoBox->setType(InfoWindowType::INFO_BOX);

        $markerInfoBox = new InfoWindow('content');
        $markerInfoBox->setType(InfoWindowType::INFO_BOX);

        $marker = new Marker(new Coordinate());
        $marker->setInfoWindow($markerInfoWindow);

        $markerBox = new Marker(new Coordinate());
        $markerBox->setInfoWindow($markerInfoBox);

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);
        $map->getOverlayManager()->addMarker($markerBox);
        $map->getOverlayManager()->addInfoWindow($infoWindow);
        $map->getOverlayManager()->addInfoWindow($infoBox);

        return [
            [[$infoWindow, $infoBox, $markerInfoWindow, $markerInfoBox], $map, InfoWindowCollector::STRATEGY_MAP | InfoWindowCollector::STRATEGY_MARKER],
            [[$infoWindow, $infoBox], $map, InfoWindowCollector::STRATEGY_MAP],
            [[$markerInfoWindow, $markerInfoBox], $map, InfoWindowCollector::STRATEGY_MARKER],
            [[$infoWindow, $markerInfoWindow], $map, InfoWindowCollector::STRATEGY_MAP | InfoWindowCollector::STRATEGY_MARKER, InfoWindowType::DEFAULT_],
            [[$infoWindow], $map, InfoWindowCollector::STRATEGY_MAP, InfoWindowType::DEFAULT_],
            [[$markerInfoWindow], $map, InfoWindowCollector::STRATEGY_MARKER, InfoWindowType::DEFAULT_],
            [[$infoBox, $markerInfoBox], $map, InfoWindowCollector::STRATEGY_MAP | InfoWindowCollector::STRATEGY_MARKER, InfoWindowType::INFO_BOX],
            [[$infoBox], $map, InfoWindowCollector::STRATEGY_MAP, InfoWindowType::INFO_BOX],
            [[$markerInfoBox], $map, InfoWindowCollector::STRATEGY_MARKER, InfoWindowType::INFO_BOX],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }
}
