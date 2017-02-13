<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete\Response;

use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompletePrediction;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompletePredictionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompletePrediction
     */
    private $prediction;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->prediction = new PlaceAutocompletePrediction();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->prediction->hasPlaceId());
        $this->assertNull($this->prediction->getPlaceId());
        $this->assertFalse($this->prediction->hasDescription());
        $this->assertNull($this->prediction->getDescription());
        $this->assertFalse($this->prediction->hasTypes());
        $this->assertEmpty($this->prediction->getTypes());
        $this->assertFalse($this->prediction->hasTerms());
        $this->assertEmpty($this->prediction->getTerms());
        $this->assertFalse($this->prediction->hasMatches());
        $this->assertEmpty($this->prediction->getMatches());
    }

    public function testPlaceId()
    {
        $this->prediction->setPlaceId($placeId = 'place');

        $this->assertTrue($this->prediction->hasPlaceId());
        $this->assertSame($placeId, $this->prediction->getPlaceId());
    }

    public function testDescription()
    {
        $this->prediction->setDescription($description = 'foo');

        $this->assertTrue($this->prediction->hasDescription());
        $this->assertSame($description, $this->prediction->getDescription());
    }

    public function testSetTypes()
    {
        $this->prediction->setTypes($types = [$type = AutocompleteType::ESTABLISHMENT]);
        $this->prediction->setTypes($types);

        $this->assertTrue($this->prediction->hasTypes());
        $this->assertTrue($this->prediction->hasType($type));
        $this->assertSame($types, $this->prediction->getTypes());
    }

    public function testAddTypes()
    {
        $this->prediction->setTypes($firstTypes = [AutocompleteType::ESTABLISHMENT]);
        $this->prediction->addTypes($secondTypes = [AutocompleteType::CITIES]);

        $this->assertTrue($this->prediction->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->prediction->getTypes());
    }

    public function testAddType()
    {
        $this->prediction->addType($type = AutocompleteType::ESTABLISHMENT);

        $this->assertTrue($this->prediction->hasTypes());
        $this->assertTrue($this->prediction->hasType($type));
        $this->assertSame([$type], $this->prediction->getTypes());
    }

    public function testRemoveType()
    {
        $this->prediction->addType($type = AutocompleteType::ESTABLISHMENT);
        $this->prediction->removeType($type);

        $this->assertFalse($this->prediction->hasTypes());
        $this->assertFalse($this->prediction->hasType($type));
        $this->assertEmpty($this->prediction->getTypes());
    }

    public function testSetTerms()
    {
        $this->prediction->setTerms($terms = [$term = $this->createTermMock()]);
        $this->prediction->setTerms($terms);

        $this->assertTrue($this->prediction->hasTerms());
        $this->assertTrue($this->prediction->hasTerm($term));
        $this->assertSame($terms, $this->prediction->getTerms());
    }

    public function testAddTerms()
    {
        $this->prediction->setTerms($firstTerms = [$this->createTermMock()]);
        $this->prediction->addTerms($secondTerms = [$this->createTermMock()]);

        $this->assertTrue($this->prediction->hasTerms());
        $this->assertSame(array_merge($firstTerms, $secondTerms), $this->prediction->getTerms());
    }

    public function testAddTerm()
    {
        $this->prediction->addTerm($term = $this->createTermMock());

        $this->assertTrue($this->prediction->hasTerms());
        $this->assertTrue($this->prediction->hasTerm($term));
        $this->assertSame([$term], $this->prediction->getTerms());
    }

    public function testRemoveTerm()
    {
        $this->prediction->addTerm($term = $this->createTermMock());
        $this->prediction->removeTerm($term);

        $this->assertFalse($this->prediction->hasTerms());
        $this->assertFalse($this->prediction->hasTerm($term));
        $this->assertEmpty($this->prediction->getTerms());
    }

    public function testSetMatches()
    {
        $this->prediction->setMatches($matches = [$match = $this->createMatchMock()]);
        $this->prediction->setMatches($matches);

        $this->assertTrue($this->prediction->hasMatches());
        $this->assertTrue($this->prediction->hasMatch($match));
        $this->assertSame($matches, $this->prediction->getMatches());
    }

    public function testAddMatches()
    {
        $this->prediction->setMatches($firstMatches = [$this->createMatchMock()]);
        $this->prediction->addMatches($secondMatches = [$this->createMatchMock()]);

        $this->assertTrue($this->prediction->hasMatches());
        $this->assertSame(array_merge($firstMatches, $secondMatches), $this->prediction->getMatches());
    }

    public function testAddMatch()
    {
        $this->prediction->addMatch($match = $this->createMatchMock());

        $this->assertTrue($this->prediction->hasMatches());
        $this->assertTrue($this->prediction->hasMatch($match));
        $this->assertSame([$match], $this->prediction->getMatches());
    }

    public function testRemoveMatch()
    {
        $this->prediction->addMatch($match = $this->createMatchMock());
        $this->prediction->removeMatch($match);

        $this->assertFalse($this->prediction->hasMatches());
        $this->assertFalse($this->prediction->hasMatch($match));
        $this->assertEmpty($this->prediction->getMatches());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceAutocompleteTerm
     */
    private function createTermMock()
    {
        return $this->createMock(PlaceAutocompleteTerm::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceAutocompleteMatch
     */
    private function createMatchMock()
    {
        return $this->createMock(PlaceAutocompleteMatch::class);
    }
}
