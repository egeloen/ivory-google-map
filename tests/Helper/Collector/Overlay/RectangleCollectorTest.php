<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RectangleCollector
     */
    private $rectangleCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangleCollector = new RectangleCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addRectangle($rectangle = new Rectangle(new Bound()));

        $this->assertSame([$rectangle], $this->rectangleCollector->collect($map));
    }
}
