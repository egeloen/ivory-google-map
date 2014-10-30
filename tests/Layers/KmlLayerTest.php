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

use Ivory\GoogleMap\Layers\KmlLayer;

/**
 * Kml layer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Layers\KmlLayer */
    private $kmlLayer;

    /** @var string */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayer = new KmlLayer($this->url = 'url');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->url);
        unset($this->kmlLayer);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->kmlLayer);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('kml_layer_', $this->kmlLayer->getVariable());
        $this->assertSame($this->url, $this->kmlLayer->getUrl());
        $this->assertFalse($this->kmlLayer->hasOptions());
    }

    public function testSetUrl()
    {
        $this->kmlLayer->setUrl($url = 'foo');

        $this->assertSame($url, $this->kmlLayer->getUrl());
    }
}
