<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Places;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Autocomplete coordinate aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $boundAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateAggregator = new AutocompleteCoordinateAggregator(
            $this->boundAggregator = $this->createAutocompleteBoundAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundAggregator);
        unset($this->coordinateAggregator);
    }

    public function testDefaultState()
    {
        $this->coordinateAggregator = new AutocompleteCoordinateAggregator();

        $this->assertAutocompleteBoundAggregatorInstance($this->coordinateAggregator->getBoundAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->boundAggregator, $this->coordinateAggregator->getBoundAggregator());
    }

    public function testSetBoundAggregator()
    {
        $this->coordinateAggregator->setBoundAggregator(
            $boundAggregator = $this->createAutocompleteBoundAggregatorMock()
        );

        $this->assertSame($boundAggregator, $this->coordinateAggregator->getBoundAggregator());
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $bounds = array(), array $coordinates = array())
    {
        $this->boundAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue($bounds));

        $this->assertSame($expected, $this->coordinateAggregator->aggregate($autocomplete, $coordinates));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $emptyBound = $this->createBoundMock();
        $southWestBound = $this->createBoundMock($coordinate1 = $this->createCoordinateMock());
        $northEastBound = $this->createBoundMock(null, $coordinate2 = $this->createCoordinateMock());
        $fullBound = $this->createBoundMock($coordinate3 = $this->createCoordinateMock(), $coordinate1);

        $simpleBounds = array($emptyBound, $southWestBound, $northEastBound);
        $fullBounds = array($emptyBound, $southWestBound, $northEastBound, $fullBound);

        $simpleCoordinates = array($coordinate1, $coordinate2);
        $fullCoordinates = array($coordinate1, $coordinate2, $coordinate3);

        return array(
            array(array()),
            array($simpleCoordinates, $simpleBounds),
            array($fullCoordinates, $fullBounds),
            array($fullCoordinates, $fullBounds, $simpleCoordinates),
        );
    }

    /**
     * Creates a bound mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west.
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east.
     *
     * @return \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject The bound mock.
     */
    protected function createBoundMock(Coordinate $southWest = null, Coordinate $northEast = null)
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('hasSouthWest')
            ->will($this->returnValue($southWest !== null));

        $bound
            ->expects($this->any())
            ->method('getSouthWest')
            ->will($this->returnValue($southWest));

        $bound
            ->expects($this->any())
            ->method('hasNorthEast')
            ->will($this->returnValue($northEast !== null));

        $bound
            ->expects($this->any())
            ->method('getNorthEast')
            ->will($this->returnValue($northEast));

        return $bound;
    }
}
