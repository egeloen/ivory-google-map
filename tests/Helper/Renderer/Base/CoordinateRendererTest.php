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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\CoordinateRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CoordinateRenderer
     */
    private $coordinateRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateRenderer = new CoordinateRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->coordinateRenderer);
    }

    public function testRender()
    {
        $coordinate = new Coordinate(1.2, 2.3);
        $coordinate->setVariable('coordinate');

        $this->assertSame(
            'coordinate=new google.maps.LatLng(1.2,2.3,true)',
            $this->coordinateRenderer->render($coordinate)
        );
    }
}
