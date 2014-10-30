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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Circle renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer */
    private $circleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circleRenderer = new CircleRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circleRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->circleRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'new google.maps.Circle({"map":map,"center":coordinate,"radius":1.234,"foo":"bar"})',
            $this->circleRenderer->render($this->createCircleMock(), $this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createCircleMock()
    {
        $circle = parent::createCircleMock();
        $circle
            ->expects($this->any())
            ->method('getCenter')
            ->will($this->returnValue($this->createCoordinateMock()));

        $circle
            ->expects($this->any())
            ->method('getRadius')
            ->will($this->returnValue(1.234));

        $circle
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $circle;
    }

    /**
     * {@inheritdoc}
     */
    protected function createCoordinateMock()
    {
        $coordinate = parent::createCoordinateMock();
        $coordinate
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('coordinate'));

        return $coordinate;
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
}
