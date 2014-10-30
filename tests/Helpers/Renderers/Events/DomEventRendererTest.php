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
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Dom event renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer */
    private $domEventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEventRenderer = new DomEventRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->domEventRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, DomEvent $domEvent)
    {
        $this->assertSame($expected, $this->domEventRenderer->render($domEvent));
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
                'google.maps.event.addDomListener(instance,"click",handle,true)',
                $this->createDomEventMock(),
            ),
            array(
                'google.maps.event.addDomListener(instance,"click",handle,false)',
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
