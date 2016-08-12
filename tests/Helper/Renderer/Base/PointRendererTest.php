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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\PointRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PointRenderer
     */
    private $pointRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointRenderer = new PointRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->pointRenderer);
    }

    public function testRender()
    {
        $point = new Point(1.2, 2.3);
        $point->setVariable('point');

        $this->assertSame(
            'point=new google.maps.Point(1.2,2.3)',
            $this->pointRenderer->render($point)
        );
    }
}
