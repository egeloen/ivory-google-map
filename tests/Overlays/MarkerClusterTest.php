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

use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMap\Overlays\MarkerClusterType;

/**
 * Marker cluster test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerCluster */
    private $markerCluster;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerCluster = new MarkerCluster();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerCluster);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->markerCluster);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('marker_cluster_', $this->markerCluster->getVariable());
        $this->assertNoMarkers();
        $this->assertSame(MarkerClusterType::DEFAULT_, $this->markerCluster->getType());
        $this->assertFalse($this->markerCluster->hasOptions());
    }

    public function testSetMarkers()
    {
        $this->markerCluster->setMarkers($markers = array($this->createMarkerMock()));

        $this->assertMarkers($markers);
    }

    public function testAddMarkers()
    {
        $this->markerCluster->setMarkers($markers = array($this->createMarkerMock()));
        $this->markerCluster->addMarkers($newMarkers = array($this->createMarkerMock()));

        $this->assertMarkers(array_merge($markers, $newMarkers));
    }

    public function testRemoveMarkers()
    {
        $this->markerCluster->setMarkers($markers = array($this->createMarkerMock()));
        $this->markerCluster->removeMarkers($markers);

        $this->assertNoMarkers();
    }

    public function testResetMarkers()
    {
        $this->markerCluster->setMarkers(array($this->createMarkerMock()));
        $this->markerCluster->resetMarkers();

        $this->assertNoMarkers();
    }

    public function testAddMarker()
    {
        $this->markerCluster->addMarker($marker = $this->createMarkerMock());

        $this->assertMarker($marker);
    }

    public function testAddMarkerUnicity()
    {
        $this->markerCluster->resetMarkers();
        $this->markerCluster->addMarker($marker = $this->createMarkerMock());
        $this->markerCluster->addMarker($marker);

        $this->assertMarkers(array($marker));
    }

    public function testRemoveMarker()
    {
        $this->markerCluster->addMarker($marker = $this->createMarkerMock());
        $this->markerCluster->removeMarker($marker);

        $this->assertNoMarker($marker);
    }

    public function testSetType()
    {
        $this->markerCluster->setType($type = MarkerClusterType::MARKER_CLUSTER);

        $this->assertSame($type, $this->markerCluster->getType());
    }

    /**
     * Asserts there are markers.
     *
     * @param array $markers The markers.
     */
    private function assertMarkers($markers)
    {
        $this->assertInternalType('array', $markers);

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertSame($markers, $this->markerCluster->getMarkers());

        foreach ($markers as $marker) {
            $this->assertMarker($marker);
        }
    }

    /**
     * Asserts there is a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    private function assertMarker($marker)
    {
        $this->assertMarkerInstance($marker);
        $this->assertTrue($this->markerCluster->hasMarker($marker));
    }

    /**
     * Asserts there are no markers.
     */
    private function assertNoMarkers()
    {
        $this->assertFalse($this->markerCluster->hasMarkers());
        $this->assertEmpty($this->markerCluster->getMarkers());
    }

    /**
     * Asserts there is no marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    private function assertNoMarker($marker)
    {
        $this->assertMarkerInstance($marker);
        $this->assertFalse($this->markerCluster->hasMarker($marker));
    }
}
