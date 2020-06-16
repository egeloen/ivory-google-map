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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointRendererTest extends TestCase
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
        $this->pointRenderer = new PointRenderer();
    }

    public function testRender()
    {
        $this->assertSame(
            '1.2,2.3',
            $this->pointRenderer->render(new Point(1.2, 2.3))
        );
    }
}
