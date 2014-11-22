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

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent;

/**
 * Places autocomplete event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteEventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent */
    private $placesAutocompleteEvent;

    /** @var \Ivory\GoogleMap\Places\Autocomplete|\PHPUnit_Framework_MockObject_MockObject */
    private $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->placesAutocompleteEvent = new PlacesAutocompleteEvent($this->autocomplete = $this->createAutocompleteMock());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->placesAutocompleteEvent);
    }

    public function testInheritance()
    {
        $this->assertHelperEventInstance($this->placesAutocompleteEvent);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->autocomplete, $this->placesAutocompleteEvent->getAutocomplete());
    }
}
