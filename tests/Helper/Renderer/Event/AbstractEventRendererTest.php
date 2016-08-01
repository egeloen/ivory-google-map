<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\AbstractEventRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractEventRendererTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractEventRenderer|\\PHPUnit_Framework_MockObject_MockObject
     */
    private $eventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventRenderer = $this->createAbstractEventRendererMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->eventRenderer);
    }

    public function testRender()
    {
        $event = new Event('instance', 'trigger', 'handle');
        $event->setVariable('event');

        $this->assertSame(
            'event=google.maps.event.method(instance,"trigger",handle,false)',
            $this->eventRenderer->render($event)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractEventRenderer
     */
    private function createAbstractEventRendererMock()
    {
        $eventRenderer = $this->getMockBuilder(AbstractEventRenderer::class)
            ->setConstructorArgs([new Formatter()])
            ->getMockForAbstractClass();

        $eventRenderer
            ->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('method'));

        return $eventRenderer;
    }
}
