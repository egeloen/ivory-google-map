<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Layers;

use Ivory\GoogleMap\Layers\Layers;

/**
 * Layers test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayersTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Layers\Layers */
    private $layers;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->layers = new Layers();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->layers);
    }

    public function testDefaultState()
    {
        $this->assertNoKmlLayers();
    }

    public function testSetKmlLayers()
    {
        $this->layers->setKmlLayers($kmlLayers = array($this->createKmlLayerMock()));

        $this->assertKmlLayers($kmlLayers);
    }

    public function testAddKmlLayers()
    {
        $this->layers->setKmlLayers($kmlLayers = array($this->createKmlLayerMock()));
        $this->layers->addKmlLayers($newKmlLayers = array($this->createKmlLayerMock()));

        $this->assertKmlLayers(array_merge($kmlLayers, $newKmlLayers));
    }

    public function testRemoveKmlLayers()
    {
        $this->layers->setKmlLayers($kmlLayers = array($this->createKmlLayerMock()));
        $this->layers->removeKmlLayers($kmlLayers);

        $this->assertNoKmlLayers();
    }

    public function testResetKmlLayers()
    {
        $this->layers->setKmlLayers(array($this->createKmlLayerMock()));
        $this->layers->resetKmlLayers();

        $this->assertNoKmlLayers();
    }

    public function testAddKmlLayer()
    {
        $this->layers->addKmlLayer($kmlLayer = $this->createKmlLayerMock());

        $this->assertKmlLayer($kmlLayer);
    }

    public function testAddKmlLayerUnicity()
    {
        $this->layers->resetKmlLayers();
        $this->layers->addKmlLayer($kmlLayer = $this->createKmlLayerMock());
        $this->layers->addKmlLayer($kmlLayer);

        $this->assertKmlLayers(array($kmlLayer));
    }

    public function testRemoveKmlLayer()
    {
        $this->layers->addKmlLayer($kmlLayer = $this->createKmlLayerMock());
        $this->layers->removeKmlLayer($kmlLayer);

        $this->assertNoKmlLayer($kmlLayer);
    }

    /**
     * Asserts there are kml layers.
     *
     * @param array $kmlLayers The kml layers.
     */
    private function assertKmlLayers($kmlLayers)
    {
        $this->assertInternalType('array', $kmlLayers);

        $this->assertTrue($this->layers->hasKmlLayers());
        $this->assertSame($kmlLayers, $this->layers->getKmlLayers());

        foreach ($kmlLayers as $kmlLayer) {
            $this->assertKmlLayer($kmlLayer);
        }
    }

    /**
     * Asserts there is a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     */
    private function assertKmlLayer($kmlLayer)
    {
        $this->assertKmlLayerInstance($kmlLayer);
        $this->assertTrue($this->layers->hasKmlLayer($kmlLayer));
    }

    /**
     * Asserts there are no kml layers.
     */
    private function assertNoKmlLayers()
    {
        $this->assertFalse($this->layers->hasKmlLayers());
        $this->assertEmpty($this->layers->getKmlLayers());
    }

    /**
     * Asserts there is no kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     */
    private function assertNoKmlLayer($kmlLayer)
    {
        $this->assertKmlLayerInstance($kmlLayer);
        $this->assertFalse($this->layers->hasKmlLayer($kmlLayer));
    }
}
