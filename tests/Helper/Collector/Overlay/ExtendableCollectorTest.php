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

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Helper\Collector\Overlay\ExtendableCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableCollectorTest extends TestCase
{
    /**
     * @var ExtendableCollector
     */
    private $extendableCollector;

    protected function setUp(): void
    {
        $this->extendableCollector = new ExtendableCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getBound()->addExtendable($extendable = $this->createExtendableMock());

        $this->assertSame([$extendable], $this->extendableCollector->collect($map));
    }

    /**
     * @return MockObject|ExtendableInterface
     */
    private function createExtendableMock()
    {
        return $this->createMock(ExtendableInterface::class);
    }
}
