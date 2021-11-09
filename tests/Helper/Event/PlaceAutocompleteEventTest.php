<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Event;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Place\Autocomplete;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteEventTest extends TestCase
{
    private PlaceAutocompleteEvent $placeAutocompleteEvent;

    /**
     * @var Autocomplete|MockObject
     */
    private $autocomplete;

    protected function setUp(): void
    {
        $this->autocomplete = $this->createAutocompleteMock();
        $this->placeAutocompleteEvent = new PlaceAutocompleteEvent($this->autocomplete);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractEvent::class, $this->placeAutocompleteEvent);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->autocomplete, $this->placeAutocompleteEvent->getAutocomplete());
    }

    /**
     * @return MockObject|Autocomplete
     */
    private function createAutocompleteMock()
    {
        return $this->createMock(Autocomplete::class);
    }
}
