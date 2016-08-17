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

use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeoJsonLayer
     */
    private $geoJsonLayer;

    /**
     * @var string
     */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geoJsonLayer = new GeoJsonLayer($this->url = 'https://storage.googleapis.com/mapsdevsite/json/google.json');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->geoJsonLayer);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->url, $this->geoJsonLayer->getUrl());
        $this->assertFalse($this->geoJsonLayer->hasOptions());
    }

    public function testInitialState()
    {
        $this->geoJsonLayer = new GeoJsonLayer($this->url, $options = ['foo' => 'bar']);

        $this->assertSame($this->url, $this->geoJsonLayer->getUrl());
        $this->assertSame($options, $this->geoJsonLayer->getOptions());
    }

    public function testUrl()
    {
        $this->geoJsonLayer->setUrl($url = 'https://storage.googleapis.com/mapsdevsite/json/google.json');

        $this->assertSame($url, $this->geoJsonLayer->getUrl());
    }
}
