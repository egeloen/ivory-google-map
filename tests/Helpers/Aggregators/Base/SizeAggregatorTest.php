<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Size aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator */
    private $sizeAggreator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $iconAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeAggreator = new SizeAggregator(
            $this->infoWindowAggregator = $this->createInfoWindowAggregatorMock(),
            $this->iconAggregator = $this->createIconAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->iconAggregator);
        unset($this->infoWindowAggregator);
        unset($this->sizeAggreator);
    }

    public function testDefaultState()
    {
        $this->sizeAggreator = new SizeAggregator();

        $this->assertInfoWindowAggregatorInstance($this->sizeAggreator->getInfoWindowAggregator());
        $this->assertIconAggregatorInstance($this->sizeAggreator->getIconAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->infoWindowAggregator, $this->sizeAggreator->getInfoWindowAggregator());
        $this->assertSame($this->iconAggregator, $this->sizeAggreator->getIconAggregator());
    }

    public function testSetInfoWindowAggregator()
    {
        $this->sizeAggreator->setInfoWindowAggregator($infoWindowAggregator = $this->createInfoWindowAggregatorMock());

        $this->assertSame($infoWindowAggregator, $this->sizeAggreator->getInfoWindowAggregator());
    }

    public function testSetIconAggregator()
    {
        $this->sizeAggreator->setIconAggregator($iconAggregator = $this->createIconAggregatorMock());

        $this->assertSame($iconAggregator, $this->sizeAggreator->getIconAggregator());
    }

    /**
     * @dataProvider aggregateInfoWindowsProvider
     */
    public function testAggregateInfoWindows(array $expected, array $infoWindows = array(), array $sizes = array())
    {
        $map = $this->createMapMock();

        $this->infoWindowAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($infoWindows));

        $this->assertEquals($expected, $this->sizeAggreator->aggregateInfoWindows($map, $sizes));
    }

    /**
     * @dataProvider aggregateIconsProvider
     */
    public function testAggregateIcons(array $expected, array $icons = array(), array $sizes = array())
    {
        $map = $this->createMapMock();

        $this->iconAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($icons));

        $this->assertEquals($expected, $this->sizeAggreator->aggregateIcons($map, $sizes));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(
        array $expected,
        array $infoWindows = array(),
        array $icons = array(),
        array $sizes = array()
    ) {
        $map = $this->createMapMock();

        $this->infoWindowAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($infoWindows));

        $this->iconAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($icons));

        $this->assertEquals($expected, $this->sizeAggreator->aggregate($map, $sizes));
    }

    /**
     * Gets the aggregate info windows provider.
     *
     * @return array The aggregate info windows provider.
     */
    public function aggregateInfoWindowsProvider()
    {
        $infoWindow1 = $this->createInfoWindowMock();
        $infoWindow2 = $this->createInfoWindowMock($size1 = $this->createSizeMock());
        $infoWindow3 = $this->createInfoWindowMock($size2 = $this->createSizeMock());
        $infoWindow4 = $this->createInfoWindowMock($size1);

        $simpleInfoWindows = array($infoWindow1, $infoWindow2);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3, $infoWindow4);

        $simpleSizes = array($size1);
        $fullSizes = array($size1, $size2);

        return array(
            array(array()),
            array($simpleSizes, $simpleInfoWindows),
            array($fullSizes, $fullInfoWindows),
            array($fullSizes, $fullInfoWindows, $simpleSizes),
        );
    }

    /**
     * Gets the aggregate icons provider.
     *
     * @return array The aggregate icons provider.
     */
    public function aggregateIconsProvider()
    {
        $icon1 = $this->createIconMock();
        $icon2 = $this->createIconMock($size1 = $this->createSizeMock());
        $icon3 = $this->createIconMock($size2 = $this->createSizeMock(), $size3 = $this->createSizeMock());
        $icon4 = $this->createIconMock($size1, $size4 = $this->createSizeMock());

        $simpleIcons = array($icon1, $icon2, $icon3);
        $fullIcons = array($icon1, $icon2, $icon3, $icon4);

        $simpleSizes = array($size1, $size2, $size3);
        $fullSizes = array($size1, $size2, $size3, $size4);

        return array(
            array(array()),
            array($simpleSizes, $simpleIcons),
            array($fullSizes, $fullIcons),
            array($fullSizes, $fullIcons, $simpleSizes),
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $infoWindow1 = $this->createInfoWindowMock();
        $infoWindow2 = $this->createInfoWindowMock($size1 = $this->createSizeMock());
        $infoWindow3 = $this->createInfoWindowMock($size2 = $this->createSizeMock());
        $infoWindow4 = $this->createInfoWindowMock($size1);

        $icon1 = $this->createIconMock();
        $icon2 = $this->createIconMock($size3 = $this->createSizeMock());
        $icon3 = $this->createIconMock($size4 = $this->createSizeMock(), $size5 = $this->createSizeMock());
        $icon4 = $this->createIconMock($size3, $size6 = $this->createSizeMock());

        $simpleInfoWindows = array($infoWindow1, $infoWindow2);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3, $infoWindow4);

        $simpleIcons = array($icon1, $icon2, $icon3);
        $fullIcons = array($icon1, $icon2, $icon3, $icon4);

        $simpleSizes = array($size1, $size3, $size4, $size5);
        $fullSizes = array($size1, $size2, $size3, $size4, $size5, $size6);

        return array(
            array(array()),
            array($simpleSizes, $simpleInfoWindows, $simpleIcons),
            array($fullSizes, $fullInfoWindows, $fullIcons),
            array($fullSizes, $fullInfoWindows, $fullIcons, $simpleSizes),
        );
    }

    /**
     * Creates an icon mock.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $size       The size.
     * @param \Ivory\GoogleMap\Base\Size|null $scaledSize The scaled size.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|\PHPUnit_Framework_MockObject_MockObject The icon mock.
     */
    protected function createIconMock(Size $size = null, Size $scaledSize = null)
    {
        $icon = parent::createIconMock();

        if ($size !== null) {
            $icon
                ->expects($this->any())
                ->method('hasSize')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getSize')
                ->will($this->returnValue($size));
        }

        if ($scaledSize !== null) {
            $icon
                ->expects($this->any())
                ->method('hasScaledSize')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getScaledSize')
                ->will($this->returnValue($scaledSize));
        }

        return $icon;
    }

    /**
     * Creates an info window mock.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $pixelOffset The pixel offset.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock(Size $pixelOffset = null)
    {
        $infoWindow = parent::createInfoWindowMock();

        if ($pixelOffset !== null) {
            $infoWindow
                ->expects($this->any())
                ->method('hasPixelOffset')
                ->will($this->returnValue(true));

            $infoWindow
                ->expects($this->any())
                ->method('getPixelOffset')
                ->will($this->returnValue($pixelOffset));
        }

        return $infoWindow;
    }
}
