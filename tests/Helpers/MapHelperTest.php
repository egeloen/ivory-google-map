<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\MapHelper;
use Ivory\GoogleMap\Map;

/**
 * Map helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperTest extends AbstractHelperTest
{
    /** @var \Ivory\GoogleMap\Helpers\MapHelper */
    private $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapHelper = new MapHelper($this->eventDispatcher);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapHelper);
    }

    public function testInheritance()
    {
        $this->assertHelperInstance($this->mapHelper);
    }

    public function testRenderHtml()
    {
        $map = $this->createMapMock();
        $code = 'code';

        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->identicalTo(MapEvents::HTML), $this->createMapEventCallbackConstraint($map, $code));

        $this->assertSame($code, $this->mapHelper->renderHtml($map));
    }

    public function testRenderStylesheet()
    {
        $map = $this->createMapMock();
        $code = 'code';

        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->identicalTo(MapEvents::STYLESHEET), $this->createMapEventCallbackConstraint($map, $code));

        $this->assertSame($code, $this->mapHelper->renderStylesheet($map));
    }

    public function testRenderJavascript()
    {
        $map = $this->createMapMock();
        $code = 'code';

        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->identicalTo(MapEvents::JAVASCRIPT), $this->createMapEventCallbackConstraint($map, $code));

        $this->assertSame($code, $this->mapHelper->renderJavascript($map));
    }

    public function testRender()
    {
        $map = $this->createMapMock();
        $code1 = 'code1';
        $code2 = 'code2';
        $code3 = 'code3';

        $this->eventDispatcher
            ->expects($this->exactly(3))
            ->method('dispatch')
            ->withConsecutive(
                array(MapEvents::STYLESHEET, $this->createMapEventCallbackConstraint($map, $code1)),
                array(MapEvents::HTML, $this->createMapEventCallbackConstraint($map, $code2)),
                array(MapEvents::JAVASCRIPT, $this->createMapEventCallbackConstraint($map, $code3))
            );

        $this->assertSame($code1.$code2.$code3, $this->mapHelper->render($map));
    }

    /**
     * Creates a map event callback constraint.
     *
     * @param \Ivory\GoogleMap\Map $map  The map.
     * @param string               $code The code.
     *
     * @return \PHPUnit_Framework_Constraint_Callback The map event callback constraint.
     */
    private function createMapEventCallbackConstraint(Map $map, $code)
    {
        return $this->callback(function ($mapEvent) use ($map, $code) {
            $result = $mapEvent instanceof MapEvent && $mapEvent->getMap() === $map;

            if ($result) {
                $mapEvent->addCode($code);
            }

            return $result;
        });
    }
}
