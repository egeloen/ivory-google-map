<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Controls;

use Ivory\GoogleMap\Events\Event,
    Ivory\GoogleMap\Templating\Helper\Events\EventHelper;

/**
 * Event helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Events\EventHelper */
    protected $eventHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventHelper = new EventHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventHelper);
    }

    public function testRenderDomEvent()
    {
        $domEvent = new Event('instance', 'event_name', 'handle', true);
        $domEvent->setJavascriptVariable('foo');

        $this->assertSame(
            'var foo = google.maps.event.addDomListener(instance, "event_name", handle, true);'.PHP_EOL,
            $this->eventHelper->renderDomEvent($domEvent)
        );
    }

    public function testRenderDomEventOnce()
    {
        $domEventOnce = new Event('instance', 'event_name', 'handle', true);
        $domEventOnce->setJavascriptVariable('foo');

        $this->assertSame(
            'var foo = google.maps.event.addDomListenerOnce(instance, "event_name", handle, true);'.PHP_EOL,
            $this->eventHelper->renderDomEventOnce($domEventOnce)
        );
    }

    public function testRenderEvent()
    {
        $event = new Event('instance', 'event_name', 'handle', true);
        $event->setJavascriptVariable('foo');

        $this->assertSame(
            'var foo = google.maps.event.addListener(instance, "event_name", handle);'.PHP_EOL,
            $this->eventHelper->renderEvent($event)
        );
    }

    public function testRenderEventOnce()
    {
        $eventOnce = new Event('instance', 'event_name', 'handle');
        $eventOnce->setJavascriptVariable('foo');

        $this->assertSame(
            'var foo = google.maps.event.addListenerOnce(instance, "event_name", handle);'.PHP_EOL,
            $this->eventHelper->renderEventOnce($eventOnce)
        );
    }
}
