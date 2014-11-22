<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Places;

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteHtmlSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete html subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHtmlSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteHtmlSubscriber */
    private $autocompleteHtml;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->autocompleteHtml = new AutocompleteHtmlSubscriber($this->formatter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->autocompleteHtml);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->autocompleteHtml);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteHtmlSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::HTML, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::HTML]);
    }

    /**
     * @dataProvider onAutocompleteProvider
     */
    public function testOnAutocomplete($value = null, array $inputAttributes = array())
    {
        $attributes = array(
            'id'   => 'input_id',
            'type' => 'text',
        );

        if ($value !== null) {
            $attributes['value'] = $value;
        }

        $this->formatter
            ->expects($this->once())
            ->method('formatTag')
            ->with(
                $this->identicalTo('input'),
                $this->identicalTo(null),
                $this->identicalTo(array_merge($attributes, $inputAttributes)),
                $this->identicalTo(true)
            )
            ->will($this->returnValue($code = 'code'));

        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getAutocomplete')
            ->will($this->returnValue($this->createAutocompleteMock($value, $inputAttributes)));

        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->autocompleteHtml->onAutocomplete($placesAutocompleteEvent);
    }

    /**
     * Gets the on autocomplete provider.
     *
     * @return array The on autocomplete provicer.
     */
    public function onAutocompleteProvider()
    {
        return array(
            array(),
            array('value'),
            array('value', array('foo' => 'bar')),
        );
    }

    protected function createAutocompleteMock($value = null, array $inputAttributes = array())
    {
        $autocomplete = parent::createAutocompleteMock();
        $autocomplete
            ->expects($this->any())
            ->method('getInputId')
            ->will($this->returnValue('input_id'));

        $autocomplete
            ->expects($this->any())
            ->method('hasValue')
            ->will($this->returnValue($value !== null));

        $autocomplete
            ->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue($value));

        $autocomplete
            ->expects($this->any())
            ->method('getInputAttributes')
            ->will($this->returnValue($inputAttributes));

        return $autocomplete;
    }
}
