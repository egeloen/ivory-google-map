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

use Ivory\GoogleMap\Helper\Collector\Overlay\DefaultInfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowCollectorTest extends TestCase
{
    /**
     * @var DefaultInfoWindowCollector
     */
    private $defaultInfoWindowCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->defaultInfoWindowCollector = new DefaultInfoWindowCollector(new MarkerCollector());
    }

    public function testDefaultState()
    {
        $this->assertSame(InfoWindowType::DEFAULT_, $this->defaultInfoWindowCollector->getType());
    }
}
