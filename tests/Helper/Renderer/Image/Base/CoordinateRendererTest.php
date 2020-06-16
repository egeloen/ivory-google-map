<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Image\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRendererTest extends TestCase
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
        $this->coordinateRenderer = new CoordinateRenderer();
    }

    public function testRender()
    {
        $this->assertSame(
            '1.234568,2.345679',
            $this->coordinateRenderer->render(new Coordinate(1.23456781, 2.34567891))
        );
    }
}
