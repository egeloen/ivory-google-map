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

use Ivory\GoogleMap\Events\DomEvent;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Dom event once renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer */
    private $domEventOnceRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEventOnceRenderer = new DomEventOnceRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->domEventOnceRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, DomEvent $domEvent)
    {
        $this->assertSame($expected, $this->domEventOnceRenderer->render($domEvent));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array(
                'google.maps.event.addDomListenerOnce(instance,"click",handle,true)',
                $this->createDomEventMock(),
            ),
            array(
                'google.maps.event.addDomListenerOnce(instance,"click",handle,false)',
                $this->createDomEventMock(false),
            ),
        );
    }

    /**
     * Creates a dom event mock.
     *
     * @param boolean $capture TRUE if it is captured else FALSE.
     *
     * @return \Ivory\GoogleMap\Events\DomEvent|\PHPUnit_Framework_MockObject_MockObject The dom event mock.
     */
    protected function createDomEventMock($capture = true)
    {
        $domEvent = parent::createDomEventMock();
        $domEvent
            ->expects($this->any())
            ->method('getInstance')
            ->will($this->returnValue('instance'));

        $domEvent
            ->expects($this->any())
            ->method('getEventName')
            ->will($this->returnValue(MouseEvent::CLICK));

        $domEvent
            ->expects($this->any())
            ->method('getHandle')
            ->will($this->returnValue('handle'));

        $domEvent
            ->expects($this->any())
            ->method('isCapture')
            ->will($this->returnValue($capture));

        return $domEvent;
    }
}
