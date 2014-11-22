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
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper;
use Ivory\GoogleMap\Places\Autocomplete;

/**
 * Autocomplete helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteHelperTest extends AbstractHelperTest
{
    /** @var \Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper */
    private $placesAutocompleteHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->placesAutocompleteHelper = new PlacesAutocompleteHelper($this->eventDispatcher);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->placesAutocompleteHelper);
    }

    public function testInheritance()
    {
        $this->assertHelperInstance($this->placesAutocompleteHelper);
    }

    public function testRenderHtml()
    {
        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->identicalTo(PlacesAutocompleteEvents::HTML),
                $this->createAutocompleteEventCallbackConstraint(
                    $autocomplete = $this->createAutocompleteMock(),
                    $code = 'code'
                )
            );

        $this->assertSame($code, $this->placesAutocompleteHelper->renderHtml($autocomplete));
    }

    public function testRenderJavascript()
    {
        $this->eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->identicalTo(PlacesAutocompleteEvents::JAVASCRIPT),
                $this->createAutocompleteEventCallbackConstraint(
                    $autocomplete = $this->createAutocompleteMock(),
                    $code = 'code'
                )
            );

        $this->assertSame($code, $this->placesAutocompleteHelper->renderJavascript($autocomplete));
    }

    public function testRender()
    {
        $autocomplete = $this->createAutocompleteMock();

        $this->eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->withConsecutive(
                array(
                    PlacesAutocompleteEvents::HTML,
                    $this->createAutocompleteEventCallbackConstraint($autocomplete, $code1 = 'code1'),
                ),
                array(
                    PlacesAutocompleteEvents::JAVASCRIPT,
                    $this->createAutocompleteEventCallbackConstraint($autocomplete, $code2 = 'code2'),
                )
            );

        $this->assertSame($code1.$code2, $this->placesAutocompleteHelper->render($autocomplete));
    }

    /**
     * Creates an autocomplete event callback constraint.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     * @param string                               $code         The code.
     *
     * @return \PHPUnit_Framework_Constraint_Callback The autocomplete event callback constraint.
     */
    private function createAutocompleteEventCallbackConstraint(Autocomplete $autocomplete, $code)
    {
        return $this->callback(function ($autocompleteEvent) use ($autocomplete, $code) {
            $result = $autocompleteEvent instanceof PlacesAutocompleteEvent
                && $autocompleteEvent->getAutocomplete() === $autocomplete;

            if ($result) {
                $autocompleteEvent->addCode($code);
            }

            return $result;
        });
    }
}
