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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Ground overlay renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer */
    private $groundOverlayRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlayRenderer = new GroundOverlayRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlayRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->groundOverlayRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'new google.maps.GroundOverlay("http://egeloen.fr",bound,{"map":map,"foo":"bar"})',
            $this->groundOverlayRenderer->render($this->createGroundOverlayMock(), $this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createGroundOverlayMock()
    {
        $groundOverlay = parent::createGroundOverlayMock();
        $groundOverlay
            ->expects($this->any())
            ->method('getUrl')
            ->will($this->returnValue('http://egeloen.fr'));

        $groundOverlay
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($this->createBoundMock()));

        $groundOverlay
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $groundOverlay;
    }

    /**
     * {@inheritdoc}
     */
    protected function createBoundMock()
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('bound'));

        return $bound;
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
