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

use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteEvent
     */
    private $placeAutocompleteEvent;

    /**
     * @var Autocomplete|\PHPUnit_Framework_MockObject_MockObject
     */
    private $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
     * @return \PHPUnit_Framework_MockObject_MockObject|Autocomplete
     */
    private function createAutocompleteMock()
    {
        return $this->createMock(Autocomplete::class);
    }
}
