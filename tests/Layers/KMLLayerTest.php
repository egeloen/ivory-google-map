<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Events;

use Ivory\GoogleMap\Layers\KMLLayer;

/**
 * KML layer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Layers\KMLLayer */
    protected $kmlLayer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayer = new KMLLayer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->kmlLayer);
    }

    public function testDefaultState()
    {
        $this->assertNull($this->kmlLayer->getUrl());
    }

    public function testInitialState()
    {
        $this->kmlLayer = new KMLLayer('foo');

        $this->assertSame('foo', $this->kmlLayer->getUrl());
    }

    public function testUrlWithValidValue()
    {
        $this->kmlLayer->setUrl('foo');

        $this->assertSame('foo', $this->kmlLayer->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\LayerException
     * @expectedExceptionMessage The kml layer url must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->kmlLayer->setUrl(true);
    }
}
