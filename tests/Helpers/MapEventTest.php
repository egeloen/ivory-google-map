<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\MapEvent;

/**
 * Map event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\MapEvent */
    private $mapEvent;

    /** @var \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject */
    private $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapEvent = new MapEvent($this->map = $this->createMapMock());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->map);
        unset($this->mapEvent);
    }

    public function testInheritance()
    {
        $this->assertHelperEventInstance($this->mapEvent);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->map, $this->mapEvent->getMap());
    }
}
