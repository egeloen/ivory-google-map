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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer;
use Ivory\GoogleMap\Overlays\Rectangle;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Rectangle renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer */
    private $rectangleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangleRenderer = new RectangleRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangleRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->rectangleRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Rectangle $rectangle)
    {
        $this->assertSame($expected, $this->rectangleRenderer->render($rectangle, $this->createMapMock()));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('new google.maps.Rectangle({"map":map,"bounds":bound})', $this->createRectangleMock()),
            array(
                'new google.maps.Rectangle({"map":map,"bounds":bound,"foo":"bar"})',
                $this->createRectangleMock(array('foo' => 'bar')),
            ),
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

        return $map;
    }

    /**
     * Creates a rectangle mock.
     *
     * @param array $options The options.
     *
     * @return \Ivory\GoogleMap\Overlays\Rectangle|\PHPUnit_Framework_MockObject_MockObject The rectangle mock.
     */
    protected function createRectangleMock(array $options = array())
    {
        $rectangle = parent::createRectangleMock();
        $rectangle
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($this->createBoundMock()));

        $rectangle
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue($options));

        return $rectangle;
    }
}
