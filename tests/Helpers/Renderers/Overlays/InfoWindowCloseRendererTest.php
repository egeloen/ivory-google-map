<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Info window close renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer */
    private $infoWindowCloseRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowCloseRenderer = new InfoWindowCloseRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoWindowCloseRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'info_window.close()',
            $this->infoWindowCloseRenderer->render($this->createInfoWindowMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createInfoWindowMock()
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('info_window'));

        return $infoWindow;
    }
}
