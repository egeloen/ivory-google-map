<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Extendables;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Extendable aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator */
    private $extendableAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->extendableAggregator = new ExtendableAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->extendableAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $extends = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->extendableAggregator->aggregate($this->createMapMock($extends), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $extendable1 = $this->createExtendableMock();
        $extendable2 = $this->createExtendableMock();

        $simpleExtendables = array($extendable1, $extendable2);
        $fullExtendables = array($extendable1, $extendable2, $extendable1);

        return array(
            array(array()),
            array($simpleExtendables, $simpleExtendables),
            array($simpleExtendables, $fullExtendables),
            array($simpleExtendables, $fullExtendables),
            array($simpleExtendables, $fullExtendables, array($extendable1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $extends The extends.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $extends = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($extends)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $extends The extends.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $extends = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getExtends')
            ->will($this->returnValue($extends));

        return $overlays;
    }
}
