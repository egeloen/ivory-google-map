<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Events\EventManager;
use Ivory\GoogleMap\Helper\Events\EventManagerHelper;

/**
 * Event manager helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Events\EventManagerHelper */
    protected $eventManagerHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventManagerHelper = new EventManagerHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventManagerHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Events\EventHelper',
            $this->eventManagerHelper->getEventHelper()
        );
    }

    public function testInitialState()
    {
        $eventHelper = $this->getMock('Ivory\GoogleMap\Helper\Events\EventHelper');

        $this->eventManagerHelper = new EventManagerHelper($eventHelper);

        $this->assertSame($eventHelper, $this->eventManagerHelper->getEventHelper());
    }

    public function testRender()
    {
        $domEvent = $this->getMock('Ivory\GoogleMap\Events\Event');
        $domEventOnce = $this->getMock('Ivory\GoogleMap\Events\Event');
        $event = $this->getMock('Ivory\GoogleMap\Events\Event');
        $eventOnce = $this->getMock('Ivory\GoogleMap\Events\Event');

        $eventHelper = $this->getMock('Ivory\GoogleMap\Helper\Events\EventHelper');
        $eventHelper
            ->expects($this->once())
            ->method('renderDomEvent')
            ->with($this->equalTo($domEvent))
            ->will($this->returnValue('domEvent;'));
        $eventHelper
            ->expects($this->once())
            ->method('renderDomEventOnce')
            ->with($this->equalTo($domEventOnce))
            ->will($this->returnValue('domEventOnce;'));
        $eventHelper
            ->expects($this->once())
            ->method('renderEvent')
            ->with($this->equalTo($event))
            ->will($this->returnValue('event;'));
        $eventHelper
            ->expects($this->once())
            ->method('renderEventOnce')
            ->with($this->equalTo($eventOnce))
            ->will($this->returnValue('eventOnce;'));

        $eventManager = new EventManager(array($domEvent), array($domEventOnce), array($event), array($eventOnce));

        $this->eventManagerHelper->setEventHelper($eventHelper);
        $this->assertSame('domEvent;domEventOnce;event;eventOnce;', $this->eventManagerHelper->render($eventManager));
    }
}
