<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Control;

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Collector\Control\CustomControlCollector;
use Ivory\GoogleMap\Map;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlCollectorTest extends TestCase
{
    /**
     * @var CustomControlCollector
     */
    private $customControlCollector;

    protected function setUp(): void
    {
        $this->customControlCollector = new CustomControlCollector();
    }

    public function testCollect()
    {
        $customControl = new CustomControl(ControlPosition::TOP_CENTER, 'control');

        $map = new Map();
        $map->getControlManager()->addCustomControl($customControl);

        $this->assertSame([$customControl], $this->customControlCollector->collect($map));
    }
}
