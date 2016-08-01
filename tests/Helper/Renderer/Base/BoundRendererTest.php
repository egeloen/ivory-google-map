<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\BoundRenderer;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BoundRenderer
     */
    private $boundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundRenderer = new BoundRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->boundRenderer);
    }

    public function testRender()
    {
        $bound = new Bound();
        $bound->setVariable('bound');

        $this->assertSame(
            'bound=new google.maps.LatLngBounds()',
            $this->boundRenderer->render($bound)
        );
    }

    public function testRenderWithCoordinates()
    {
        $southWest = new Coordinate();
        $southWest->setVariable('south_west');

        $northEast = new Coordinate();
        $northEast->setVariable('north_east');

        $bound = new Bound($southWest, $northEast);
        $bound->setVariable('bound');

        $this->assertSame(
            'bound=new google.maps.LatLngBounds(south_west,north_east)',
            $this->boundRenderer->render($bound)
        );
    }

    public function testRenderWithExtendables()
    {
        $bound = new Bound(new Coordinate(), new Coordinate());
        $bound->setVariable('bound');
        $bound->addExtendable($this->createExtendableMock());

        $this->assertSame(
            'bound=new google.maps.LatLngBounds()',
            $this->boundRenderer->render($bound)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ExtendableInterface
     */
    private function createExtendableMock()
    {
        return $this->createMock(ExtendableInterface::class);
    }
}
