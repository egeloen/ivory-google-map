<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Layer;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LayerManager
     */
    private $layerManager;

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

        $this->layerManager = new LayerManager();
        $this->layerManager->setMap($this->map);
    }

    public function testDefaultState()
    {
        $this->layerManager = new LayerManager();

        $this->assertFalse($this->layerManager->hasMap());
        $this->assertNull($this->layerManager->getMap());
        $this->assertFalse($this->layerManager->hasGeoJsonLayers());
        $this->assertEmpty($this->layerManager->getGeoJsonLayers());
        $this->assertFalse($this->layerManager->hasHeatmapLayers());
        $this->assertEmpty($this->layerManager->getHeatmapLayers());
        $this->assertFalse($this->layerManager->hasKmlLayers());
        $this->assertEmpty($this->layerManager->getKmlLayers());
    }

    public function testMap()
    {
        $map = $this->createMapMock();
        $map
            ->expects($this->once())
            ->method('getLayerManager')
            ->will($this->returnValue(null));

        $map
            ->expects($this->once())
            ->method('setLayerManager')
            ->with($this->identicalTo($this->layerManager));

        $this->layerManager->setMap($map);

        $this->assertTrue($this->layerManager->hasMap());
        $this->assertSame($map, $this->layerManager->getMap());
    }

    public function testSetGeoJsonLayers()
    {
        $this->layerManager->setGeoJsonLayers($geoJsonLayers = [$geoJsonLayer = $this->createGeoJsonLayerMock()]);
        $this->layerManager->setGeoJsonLayers($geoJsonLayers);

        $this->assertTrue($this->layerManager->hasGeoJsonLayers());
        $this->assertTrue($this->layerManager->hasGeoJsonLayer($geoJsonLayer));
        $this->assertSame($geoJsonLayers, $this->layerManager->getGeoJsonLayers());
    }

    public function testAddGeoJsonLayers()
    {
        $this->layerManager->setGeoJsonLayers($firstGeoJsonLayers = [$this->createGeoJsonLayerMock()]);
        $this->layerManager->addGeoJsonLayers($secondGeoJsonLayers = [$this->createGeoJsonLayerMock()]);

        $this->assertTrue($this->layerManager->hasGeoJsonLayers());
        $this->assertSame(
            array_merge($firstGeoJsonLayers, $secondGeoJsonLayers),
            $this->layerManager->getGeoJsonLayers()
        );
    }

    public function testAddGeoJsonLayer()
    {
        $this->layerManager->addGeoJsonLayer($geoJsonLayer = $this->createGeoJsonLayerMock());

        $this->assertTrue($this->layerManager->hasGeoJsonLayers());
        $this->assertTrue($this->layerManager->hasGeoJsonLayer($geoJsonLayer));
        $this->assertSame([$geoJsonLayer], $this->layerManager->getGeoJsonLayers());
    }

    public function testRemoveGeoJsonLayer()
    {
        $this->layerManager->addGeoJsonLayer($geoJsonLayer = $this->createGeoJsonLayerMock());
        $this->layerManager->removeGeoJsonLayer($geoJsonLayer);

        $this->assertFalse($this->layerManager->hasGeoJsonLayers());
        $this->assertFalse($this->layerManager->hasGeoJsonLayer($geoJsonLayer));
        $this->assertEmpty($this->layerManager->getGeoJsonLayers());
    }

    public function testSetHeatmapLayers()
    {
        $this->layerManager->setHeatmapLayers($heatmapLayers = [$heatmapLayer = $this->createHeatmapLayerMock()]);
        $this->layerManager->setHeatmapLayers($heatmapLayers);

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertTrue($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertSame($heatmapLayers, $this->layerManager->getHeatmapLayers());
    }

    public function testSetHeatmapLayersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($heatmapLayer = $this->createHeatmapLayerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($heatmapLayer));

        $this->layerManager->setHeatmapLayers($heatmapLayers = [$heatmapLayer]);
        $this->layerManager->setHeatmapLayers($heatmapLayers);

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertTrue($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertSame($heatmapLayers, $this->layerManager->getHeatmapLayers());
    }

    public function testAddHeatmapLayers()
    {
        $this->layerManager->setHeatmapLayers($firstHeatmapLayers = [$this->createHeatmapLayerMock()]);
        $this->layerManager->addHeatmapLayers($secondHeatmapLayers = [$this->createHeatmapLayerMock()]);

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertSame(
            array_merge($firstHeatmapLayers, $secondHeatmapLayers),
            $this->layerManager->getHeatmapLayers()
        );
    }

    public function testAddHeatmapLayersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstHeatmapLayer = $this->createHeatmapLayerMock()],
                [$secondHeatmapLayer = $this->createHeatmapLayerMock()]
            );

        $this->layerManager->setHeatmapLayers($firstHeatmapLayers = [$firstHeatmapLayer]);
        $this->layerManager->addHeatmapLayers($secondHeatmapLayers = [$secondHeatmapLayer]);

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertSame(
            array_merge($firstHeatmapLayers, $secondHeatmapLayers),
            $this->layerManager->getHeatmapLayers()
        );
    }

    public function testAddHeatmapLayer()
    {
        $this->layerManager->addHeatmapLayer($heatmapLayer = $this->createHeatmapLayerMock());

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertTrue($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertSame([$heatmapLayer], $this->layerManager->getHeatmapLayers());
    }

    public function testAddHeatmapLayerWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($heatmapLayer = $this->createHeatmapLayerMock()));

        $this->layerManager->addHeatmapLayer($heatmapLayer);

        $this->assertTrue($this->layerManager->hasHeatmapLayers());
        $this->assertTrue($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertSame([$heatmapLayer], $this->layerManager->getHeatmapLayers());
    }

    public function testRemoveHeatmapLayer()
    {
        $this->layerManager->addHeatmapLayer($heatmapLayer = $this->createHeatmapLayerMock());
        $this->layerManager->removeHeatmapLayer($heatmapLayer);

        $this->assertFalse($this->layerManager->hasHeatmapLayers());
        $this->assertFalse($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertEmpty($this->layerManager->getHeatmapLayers());
    }

    public function testRemoveHeatmapLayerWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($heatmapLayer = $this->createHeatmapLayerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($heatmapLayer));

        $this->layerManager->addHeatmapLayer($heatmapLayer);
        $this->layerManager->removeHeatmapLayer($heatmapLayer);

        $this->assertFalse($this->layerManager->hasHeatmapLayers());
        $this->assertFalse($this->layerManager->hasHeatmapLayer($heatmapLayer));
        $this->assertEmpty($this->layerManager->getHeatmapLayers());
    }

    public function testSetKmlLayers()
    {
        $this->layerManager->setKmlLayers($kmlLayers = [$kmlLayer = $this->createKmlLayerMock()]);
        $this->layerManager->setKmlLayers($kmlLayers);

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertTrue($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertSame($kmlLayers, $this->layerManager->getKmlLayers());
    }

    public function testSetKmlLayersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($kmlLayer = $this->createKmlLayerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($kmlLayer));

        $this->layerManager->setKmlLayers($kmlLayers = [$kmlLayer]);
        $this->layerManager->setKmlLayers($kmlLayers);

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertTrue($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertSame($kmlLayers, $this->layerManager->getKmlLayers());
    }

    public function testAddKmlLayers()
    {
        $this->layerManager->setKmlLayers($firstKmlLayers = [$this->createKmlLayerMock()]);
        $this->layerManager->addKmlLayers($secondKmlLayers = [$this->createKmlLayerMock()]);

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertSame(array_merge($firstKmlLayers, $secondKmlLayers), $this->layerManager->getKmlLayers());
    }

    public function testAddKmlLayersWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstKmlLayer = $this->createKmlLayerMock()],
                [$secondKmlLayer = $this->createKmlLayerMock()]
            );

        $this->layerManager->setKmlLayers($firstKmlLayers = [$firstKmlLayer]);
        $this->layerManager->addKmlLayers($secondKmlLayers = [$secondKmlLayer]);

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertSame(array_merge($firstKmlLayers, $secondKmlLayers), $this->layerManager->getKmlLayers());
    }

    public function testAddKmlLayer()
    {
        $this->layerManager->addKmlLayer($kmlLayer = $this->createKmlLayerMock());

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertTrue($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertSame([$kmlLayer], $this->layerManager->getKmlLayers());
    }

    public function testAddKmlLayerWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($kmlLayer = $this->createKmlLayerMock()));

        $this->layerManager->addKmlLayer($kmlLayer);

        $this->assertTrue($this->layerManager->hasKmlLayers());
        $this->assertTrue($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertSame([$kmlLayer], $this->layerManager->getKmlLayers());
    }

    public function testRemoveKmlLayer()
    {
        $this->layerManager->addKmlLayer($kmlLayer = $this->createKmlLayerMock());
        $this->layerManager->removeKmlLayer($kmlLayer);

        $this->assertFalse($this->layerManager->hasKmlLayers());
        $this->assertFalse($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertEmpty($this->layerManager->getKmlLayers());
    }

    public function testRemoveKmlLayerWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($kmlLayer = $this->createKmlLayerMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($kmlLayer));

        $this->layerManager->addKmlLayer($kmlLayer);
        $this->layerManager->removeKmlLayer($kmlLayer);

        $this->assertFalse($this->layerManager->hasKmlLayers());
        $this->assertFalse($this->layerManager->hasKmlLayer($kmlLayer));
        $this->assertEmpty($this->layerManager->getKmlLayers());
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
     * @return \PHPUnit_Framework_MockObject_MockObject|GeoJsonLayer
     */
    private function createGeoJsonLayerMock()
    {
        return $this->createMock(GeoJsonLayer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HeatmapLayer
     */
    private function createHeatmapLayerMock()
    {
        return $this->createMock(HeatmapLayer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|KmlLayer
     */
    private function createKmlLayerMock()
    {
        return $this->createMock(KmlLayer::class);
    }
}
