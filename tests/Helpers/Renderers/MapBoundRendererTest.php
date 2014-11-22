<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

use Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer;

/**
 * Map bound renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer */
    private $mapBoundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapBoundRenderer = new MapBoundRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapBoundRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'map.fitBounds(bound)',
            $this->mapBoundRenderer->render($this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createBoundMock()
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('bound'));

        return $bound;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        $map
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($this->createBoundMock()));

        return $map;
    }
}
