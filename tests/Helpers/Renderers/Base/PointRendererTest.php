<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Base;

use Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Point renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer */
    private $pointRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointRenderer = new PointRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->pointRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'new google.maps.Point(1.234,5.678)',
            $this->pointRenderer->render($this->createPointMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createPointMock()
    {
        $point = parent::createPointMock();

        $point
            ->expects($this->any())
            ->method('getX')
            ->will($this->returnValue(1.234));

        $point
            ->expects($this->any())
            ->method('getY')
            ->will($this->returnValue(5.678));

        return $point;
    }
}
