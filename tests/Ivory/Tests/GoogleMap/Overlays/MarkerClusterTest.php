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

/**
 * Marker cluster test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerCluster */
    protected $markerCluster;

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

    public function testDefaultState()
    {
        $this->assertSame('marker_cluster_', substr($this->markerCluster->getJavascriptVariable(), 0, 15));
        $this->assertSame(MarkerCluster::_DEFAULT, $this->markerCluster->getType());
        $this->assertFalse($this->markerCluster->hasMarkers());
        $this->assertEmpty($this->markerCluster->getMarkers());
    }

    public function testType()
    {
        $this->markerCluster->setType(MarkerCluster::MARKER_CLUSTER);

        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $this->markerCluster->getType());
    }

    public function testMarker()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');
        $this->markerCluster->setMarkers(array($marker));

        $this->assertTrue($this->markerCluster->hasMarkers());
        $this->assertSame(array($marker), $this->markerCluster->getMarkers());
    }
}
