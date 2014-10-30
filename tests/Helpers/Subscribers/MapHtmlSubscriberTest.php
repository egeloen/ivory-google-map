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
use Ivory\GoogleMap\Helpers\Subscribers\MapHtmlSubscriber;

/**
 * Map html subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHtmlSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapHtmlSubscriber */
    private $mapHtmlSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapHtmlSubscriber = new MapHtmlSubscriber($this->formatter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapHtmlSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapHtmlSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapHtmlSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::HTML, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::HTML]);
    }

    /**
     * @dataProvider onMapProvider
     */
    public function testOnMap($style, $width = null, $height = null)
    {
        $this->formatter
            ->expects($this->once())
            ->method('formatTag')
            ->with(
                $this->identicalTo('div'),
                $this->identicalTo(null),
                $this->identicalTo(array(
                    'id'    => 'id',
                    'style' => $style,
                ))
            )
            ->will($this->returnValue($code = 'code'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($this->createMapMock($width, $height)));

        $mapEvent
            ->expects($this->any())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->mapHtmlSubscriber->onMap($mapEvent);
    }

    /**
     * Gets the on map provider.
     *
     * @return array The on map provider.
     */
    public function onMapProvider()
    {
        $format = 'width:%s;height:%s;';

        $defaultWidth = '300px';
        $defaultHeight = '300px';

        $customWidth = '100px';
        $customHeight = '200px';

        return array(
            array(sprintf($format, $defaultWidth, $defaultHeight)),
            array(sprintf($format, $customWidth, $defaultHeight), $customWidth),
            array(sprintf($format, $defaultWidth, $customHeight), null, $customHeight),
            array(sprintf($format, $customWidth, $customHeight), $customWidth, $customHeight),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param string $width  The width.
     * @param string $height The height.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock($width = null, $height = null)
    {
        $map = parent::createMapMock();

        if ($width === null) {
            $width = '300px';
        }

        if ($height === null) {
            $height = '300px';
        }

        $map
            ->expects($this->any())
            ->method('getHtmlContainerId')
            ->will($this->returnValue('id'));

        $map
            ->expects($this->exactly(2))
            ->method('hasStylesheetOption')
            ->will($this->returnValueMap(array(
                array('width', $width !== null),
                array('height', $height !== null),
            )));

        $map
            ->expects($this->exactly(2))
            ->method('getStylesheetOption')
            ->will($this->returnValueMap(array(
                array('width', $width),
                array('height', $height),
            )));

        return $map;
    }
}
