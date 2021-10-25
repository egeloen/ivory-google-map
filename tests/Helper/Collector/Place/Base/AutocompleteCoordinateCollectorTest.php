<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Place\Base;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Place\Base\AutocompleteBoundCollector;
use Ivory\GoogleMap\Helper\Collector\Place\Base\AutocompleteCoordinateCollector;
use Ivory\GoogleMap\Place\Autocomplete;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateCollectorTest extends TestCase
{
    /**
     * @var AutocompleteCoordinateCollector
     */
    private $autocompleteCoordinateCollector;

    protected function setUp(): void
    {
        $this->autocompleteCoordinateCollector = new AutocompleteCoordinateCollector(new AutocompleteBoundCollector());
    }

    public function testAutocompleteBoundCollector()
    {
        $autocompleteBoundCollector = $this->createAutocompleteBoundCollectorMock();
        $this->autocompleteCoordinateCollector->setBoundCollector($autocompleteBoundCollector);

        $this->assertSame($autocompleteBoundCollector, $this->autocompleteCoordinateCollector->getBoundCollector());
    }

    public function testCollect()
    {
        $this->assertEmpty($this->autocompleteCoordinateCollector->collect(new Autocomplete()));
    }

    public function testCollectBound()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setBound(new Bound(
            $southWest = new Coordinate(),
            $northEast = new Coordinate()
        ));

        $this->assertSame([$southWest, $northEast], $this->autocompleteCoordinateCollector->collect($autocomplete));
    }

    /**
     * @return MockObject|AutocompleteBoundCollector
     */
    private function createAutocompleteBoundCollectorMock()
    {
        return $this->createMock(AutocompleteBoundCollector::class);
    }
}
