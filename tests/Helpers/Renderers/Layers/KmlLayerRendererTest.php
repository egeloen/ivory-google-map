<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Layers;

use Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Kml layer renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer */
    private $kmlLayerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerRenderer = new KmlLayerRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->kmlLayerRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->kmlLayerRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'new google.maps.KmlLayer("http://egeloen.fr",{"map":map,"foo":"bar"})',
            $this->kmlLayerRenderer->render($this->createKmlLayerMock(), $this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createKmlLayerMock()
    {
        $kmlLayer = parent::createKmlLayerMock();
        $kmlLayer
           ->expects($this->any())
           ->method('getUrl')
           ->will($this->returnValue('http://egeloen.fr'));

        $kmlLayer
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $kmlLayer;
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
}
