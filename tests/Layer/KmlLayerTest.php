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
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KmlLayer
     */
    private $kmlLayer;

    /**
     * @var string
     */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayer = new KmlLayer($this->url = 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->kmlLayer);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->kmlLayer);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('kml_layer', $this->kmlLayer->getVariable());
        $this->assertSame($this->url, $this->kmlLayer->getUrl());
        $this->assertFalse($this->kmlLayer->hasOptions());
    }

    public function testInitialState()
    {
        $this->kmlLayer = new KmlLayer($this->url, $options = ['foo' => 'bar']);

        $this->assertSame($this->url, $this->kmlLayer->getUrl());
        $this->assertSame($options, $this->kmlLayer->getOptions());
    }

    public function testUrl()
    {
        $this->kmlLayer->setUrl($url = 'http://googlemaps.github.io/js-v1-samples/ggeoxml/cta.kml');

        $this->assertSame($url, $this->kmlLayer->getUrl());
    }
}
