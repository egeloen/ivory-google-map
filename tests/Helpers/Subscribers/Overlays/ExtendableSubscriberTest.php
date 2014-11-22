<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Overlays;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\ExtendableSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Map extendable subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\ExtendableSubscriber */
    private $extendableSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $extendableAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $extendableRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->extendableSubscriber = new ExtendableSubscriber(
            $this->formatter,
            $this->extendableAggregator = $this->createExtendableAggregatorMock(),
            $this->extendableRenderer = $this->createExtendableRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->extendableRenderer);
        unset($this->extendableAggregator);
        unset($this->extendableSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->extendableSubscriber);
    }

    public function testDefaultState()
    {
        $this->extendableSubscriber = new ExtendableSubscriber();

        $this->assertFormatterInstance($this->extendableSubscriber->getFormatter());
        $this->assertExtendableAggregatorInstance($this->extendableSubscriber->getExtendableAggregator());
        $this->assertExtendableRendererInstance($this->extendableSubscriber->getExtendableRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->extendableSubscriber->getFormatter());
        $this->assertSame($this->extendableAggregator, $this->extendableSubscriber->getExtendableAggregator());
        $this->assertSame($this->extendableRenderer, $this->extendableSubscriber->getExtendableRenderer());
    }

    public function testSetFormatter()
    {
        $this->extendableSubscriber->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->extendableSubscriber->getFormatter());
    }

    public function testSetExtendableAggregator()
    {
        $this->extendableSubscriber->setExtendableAggregator(
            $extendableAggregator = $this->createExtendableAggregatorMock()
        );

        $this->assertSame($extendableAggregator, $this->extendableSubscriber->getExtendableAggregator());
    }

    public function testSetExtendableRenderer()
    {
        $this->extendableSubscriber->setExtendableRenderer($extendableRenderer = $this->createExtendableRendererMock());

        $this->assertSame($extendableRenderer, $this->extendableSubscriber->getExtendableRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = ExtendableSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH_EXTENDABLE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH_EXTENDABLE]);
    }

    public function testOnMap()
    {
        $this->extendableAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($bound = $this->createBoundMock())))
            ->will($this->returnValue(array($extendable = $this->createExtendableMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatCode')
            ->with($this->identicalTo($render = 'render'))
            ->will($this->returnValue($code = 'code'));

        $this->extendableRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($extendable),
                $this->identicalTo($bound)
            )
            ->will($this->returnValue($render));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->extendableSubscriber->onMap($mapEvent);
    }

    /**
     * Creates a map mock.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(Bound $bound = null)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound));

        return $map;
    }
}
