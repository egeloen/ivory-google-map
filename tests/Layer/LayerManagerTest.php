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

use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Layer\LayerManager;

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
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->layerManager = new LayerManager();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->layerManager->hasKmlLayers());
        $this->assertEmpty($this->layerManager->getKmlLayers());
    }

    public function testSetKmlLayers()
    {
        $this->layerManager->setKmlLayers($kmlLayers = [$kmlLayer = $this->createKmlLayerMock()]);
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

    public function testAddKmlLayer()
    {
        $this->layerManager->addKmlLayer($kmlLayer = $this->createKmlLayerMock());

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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|KmlLayer
     */
    private function createKmlLayerMock()
    {
        return $this->createMock(KmlLayer::class);
    }
}
