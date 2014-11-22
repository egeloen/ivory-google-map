<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\MapStylesheetSubscriber;

/**
 * Map stylesheet subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapStylesheetSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapStylesheetSubscriber */
    private $mapStylesheetSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapStylesheetSubscriber = new MapStylesheetSubscriber($this->formatter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapStylesheetSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapStylesheetSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapStylesheetSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::STYLESHEET, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::STYLESHEET]);
    }

    public function testOnMap()
    {
        $this->formatter
            ->expects($this->once())
            ->method('formatStylesheet')
            ->with($this->identicalTo('#map', array('foo' => 'bar')))
            ->will($this->returnValue($code = 'code'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map = $this->createMapMock()));

        $mapEvent
            ->expects($this->any())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->mapStylesheetSubscriber->onMap($mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getHtmlContainerId')
            ->will($this->returnValue('map'));

        $map
            ->expects($this->any())
            ->method('hasStylesheetOptions')
            ->will($this->returnValue(true));

        $map
            ->expects($this->any())
            ->method('getStylesheetOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $map;
    }
}
