<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Ivory\GoogleMap\Overlay\MarkerClusterType;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MarkerCluster
     */
    private $markerCluster;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|OverlayManager
     */
    private $overlayManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private $map;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = $this->createBoundMock();
        $this->map = $this->createMapMock($this->bound);
        $this->overlayManager = $this->createOverlayManagerMock($this->map);

        $this->markerCluster = new MarkerCluster();
        $this->markerCluster->setOverlayManager($this->overlayManager);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->markerCluster);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->markerCluster);
    }

    public function testDefaultState()
    {
        $this->markerCluster = new MarkerCluster();

        $this->assertStringStartsWith('marker_cluster', $this->markerCluster->getVariable());
        $this->assertFalse($this->markerCluster->hasOverlayManager());
        $this->assertNull($this->markerCluster->getOverlayManager());
        $this->assertSame(MarkerClusterType::DEFAULT_, $this->markerCluster->getType());
        $this->assertFalse($this->markerCluster->hasMarkers());
        $this->assertEmpty($this->markerCluster->getMarkers());
        $this->assertFalse($this->markerCluster->hasOptions());
    }

    public function testOverlayManager()
    {
        $overlayManager = $this->createOverlayManagerMock();
        $overlayManager
            ->expects($this->once())
            ->method('getMarkerCluster')
            ->will($this->returnValue(null));

        $overlayManager
            ->expects($this->once())
            ->method('setMarkerCluster')
            ->with($this->identicalTo($this->markerCluster));

        $this->markerCluster->setOverlayManager($overlayManager);

        $this->assertTrue($this->markerCluster->hasOverlayManager());
        $this->assertSame($overlayManager, $this->markerCluster->getOverlayManager());
    }

    public function testType()
    {
        $this->markerCluster->setType($type = MarkerClusterType::MARKER_CLUSTERER);

        $this->assertSame($type, $this->markerCluster->getType());
    }

    public function testSetMarkers()
    {
        $this->markerCluster->setMarkers($markers = [$marker = $this->createMarkerMock()]);
        $this->markerCluster->setMarkers($markers);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertTrue($this->markerCluster->hasMarker($marker));
        $this->assertSame($markers, $this->markerCluster->getMarkers());
    }

    public function testSetMarkersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($marker = $this->createMarkerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($marker));

        $this->markerCluster->setOverlayManager($this->overlayManager);
        $this->markerCluster->setMarkers($markers = [$marker]);
        $this->markerCluster->setMarkers($markers);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertTrue($this->markerCluster->hasMarker($marker));
        $this->assertSame($markers, $this->markerCluster->getMarkers());
    }

    public function testAddMarkers()
    {
        $this->markerCluster->setMarkers($firstMarkers = [$this->createMarkerMock()]);
        $this->markerCluster->addMarkers($secondMarkers = [$this->createMarkerMock()]);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertSame(array_merge($firstMarkers, $secondMarkers), $this->markerCluster->getMarkers());
    }

    public function testAddMarkersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstMarker = $this->createMarkerMock()],
                [$secondMarker = $this->createMarkerMock()]
            );

        $this->markerCluster->setMarkers($firstMarkers = [$firstMarker]);
        $this->markerCluster->addMarkers($secondMarkers = [$secondMarker]);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertSame(array_merge($firstMarkers, $secondMarkers), $this->markerCluster->getMarkers());
    }

    public function testAddMarker()
    {
        $this->markerCluster->addMarker($marker = $this->createMarkerMock());

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertTrue($this->markerCluster->hasMarker($marker));
        $this->assertSame([$marker], $this->markerCluster->getMarkers());
    }

    public function testAddMarkerWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($marker = $this->createMarkerMock()));

        $this->markerCluster->addMarker($marker);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertTrue($this->markerCluster->hasMarker($marker));
        $this->assertSame([$marker], $this->markerCluster->getMarkers());
    }

    public function testRemoveMarker()
    {
        $this->markerCluster->addMarker($marker = $this->createMarkerMock());
        $this->markerCluster->removeMarker($marker);

        $this->assertFalse($this->markerCluster->hasMarkers());
        $this->assertFalse($this->markerCluster->hasMarker($marker));
        $this->assertEmpty($this->markerCluster->getMarkers());
    }

    public function testRemoveMarkerWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($marker = $this->createMarkerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($marker));

        $this->markerCluster->addMarker($marker);
        $this->markerCluster->removeMarker($marker);

        $this->assertFalse($this->markerCluster->hasMarkers());
        $this->assertFalse($this->markerCluster->hasMarker($marker));
        $this->assertEmpty($this->markerCluster->getMarkers());
    }

    /**
     * @param Map|null $map
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|OverlayManager
     */
    private function createOverlayManagerMock(Map $map = null)
    {
        $overlayManager = $this->createMock(OverlayManager::class);
        $overlayManager
            ->expects($this->any())
            ->method('hasMap')
            ->will($this->returnValue($map !== null));

        $overlayManager
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        return $overlayManager;
    }

    /**
     * @param Bound|null $bound
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock(Bound $bound = null)
    {
        $map = $this->createMock(Map::class);
        $map
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound ?: $this->createBoundMock()));

        return $map;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Marker
     */
    private function createMarkerMock()
    {
        return $this->createMock(Marker::class);
    }
}
