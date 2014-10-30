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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Autocomplete bound aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator */
    private $boundAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundAggregator = new AutocompleteBoundAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, Bound $bound = null, array $bounds = array())
    {
        $autocomplete = $this->createAutocompleteMock();
        $autocomplete
            ->expects($this->any())
            ->method('hasBound')
            ->will($this->returnValue($bound !== null));

        $autocomplete
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound));

        $this->assertSame($expected, $this->boundAggregator->aggregate($autocomplete, $bounds));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $bound = $this->createBoundMock();

        return array(
            array(array()),
            array(array($bound), $bound),
            array(array($bound), $bound, array($bound)),
        );
    }
}
