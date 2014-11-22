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

use Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer;

/**
 * Map center renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer */
    private $mapCenterRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapCenterRenderer = new MapCenterRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapCenterRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'map.setCenter(coordinate)',
            $this->mapCenterRenderer->render($this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createCoordinateMock()
    {
        $center = parent::createCoordinateMock();
        $center
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('coordinate'));

        return $center;
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
            ->method('getCenter')
            ->will($this->returnValue($this->createCoordinateMock()));

        return $map;
    }
}
