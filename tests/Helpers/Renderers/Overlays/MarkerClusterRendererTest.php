<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Marker cluster renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer */
    private $markerClusterRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerClusterRenderer = new MarkerClusterRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerClusterRenderer);
    }

    public function testRender()
    {
        $map = $this->createMapMock();
        $markerCluster = $this->createMarkerClusterMock();

        $this->assertSame(
            'new MarkerClusterer(map,markers,{"foo":"bar"})',
            $this->markerClusterRenderer->render($markerCluster, $map, 'markers')
        );
    }

    public function testRenderSource()
    {
        $this->assertSame(
            '//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js',
            $this->markerClusterRenderer->renderSource()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        return $map;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMarkerClusterMock()
    {
        $markerCluster = parent::createMarkerClusterMock();
        $markerCluster
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('marker_cluster'));

        $markerCluster
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $markerCluster;
    }
}
