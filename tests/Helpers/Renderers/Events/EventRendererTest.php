<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Events;

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Event once renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer */
    private $eventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventRenderer = new EventRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.event.addListener(instance,"click",handle)',
            $this->eventRenderer->render($this->createEventMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createEventMock()
    {
        $event = parent::createEventMock();
        $event
            ->expects($this->any())
            ->method('getInstance')
            ->will($this->returnValue('instance'));

        $event
            ->expects($this->any())
            ->method('getEventName')
            ->will($this->returnValue(MouseEvent::CLICK));

        $event
            ->expects($this->any())
            ->method('getHandle')
            ->will($this->returnValue('handle'));

        return $event;
    }
}
