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

use Ivory\GoogleMap\Helper\Collector\Overlay\ExtendableCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExtendableCollector
     */
    private $extendableCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
     * @return \PHPUnit_Framework_MockObject_MockObject|ExtendableInterface
     */
    private function createExtendableMock()
    {
        return $this->createMock(ExtendableInterface::class);
    }
}
