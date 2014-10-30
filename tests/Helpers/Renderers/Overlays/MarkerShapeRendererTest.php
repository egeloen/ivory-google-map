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

use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer;
use Ivory\GoogleMap\Overlays\MarkerShapeType;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Marker shape renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer */
    private $markerShapeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShapeRenderer = new MarkerShapeRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerShapeRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->markerShapeRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            '{"type":"circle","coords":[1.2,3.4,4.5]}',
            $this->markerShapeRenderer->render($this->createMarkerShapeMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createMarkerShapeMock()
    {
        $markerShape = parent::createMarkerShapeMock();
        $markerShape
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue(MarkerShapeType::CIRCLE));

        $markerShape
            ->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue(array(1.2, 3.4, 4.5)));

        return $markerShape;
    }
}
