<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * DistanceMatrix request test.
 *
 * @author GeLo <gelon.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest */
    protected $distanceMatrixRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixRequest = new DistanceMatrixRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->distanceMatrixRequest);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->distanceMatrixRequest->hasAvoidHighways());
        $this->assertFalse($this->distanceMatrixRequest->hasAvoidTolls());
        $this->assertFalse($this->distanceMatrixRequest->hasDestinations());
        $this->assertFalse($this->distanceMatrixRequest->hasOrigins());
        $this->assertFalse($this->distanceMatrixRequest->hasRegion());
        $this->assertFalse($this->distanceMatrixRequest->hasLanguage());
        $this->assertFalse($this->distanceMatrixRequest->hasTravelMode());
        $this->assertFalse($this->distanceMatrixRequest->hasUnitSystem());
        $this->assertFalse($this->distanceMatrixRequest->hasSensor());
    }

    public function testAvoidHightwaysWithValidValue()
    {
        $this->distanceMatrixRequest->setAvoidHighways(true);

        $this->assertTrue($this->distanceMatrixRequest->hasAvoidHighways());
        $this->assertTrue($this->distanceMatrixRequest->getAvoidHighways());
    }

    public function testAvoidHighwaysWithNullValue()
    {
        $this->distanceMatrixRequest->setAvoidHighways(true);
        $this->distanceMatrixRequest->setAvoidHighways(null);

        $this->assertNull($this->distanceMatrixRequest->getAvoidHighways());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request avoid hightways flag must be a boolean value.
     */
    public function testAvoidHighwaysWithInvalidValue()
    {
        $this->distanceMatrixRequest->setAvoidHighways('foo');
    }

    public function testAvoidTollsWithValidValue()
    {
        $this->distanceMatrixRequest->setAvoidTolls(true);

        $this->assertTrue($this->distanceMatrixRequest->hasAvoidTolls());
        $this->assertTrue($this->distanceMatrixRequest->getAvoidTolls());
    }

    public function testAvoidTollsWithNullValue()
    {
        $this->distanceMatrixRequest->setAvoidTolls(true);
        $this->distanceMatrixRequest->setAvoidTolls(null);

        $this->assertNull($this->distanceMatrixRequest->getAvoidTolls());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request avoid tolls flag must be a boolean value.
     */
    public function testAvoidTollsWithInvalidValue()
    {
        $this->distanceMatrixRequest->setAvoidTolls('foo');
    }

    public function testDestinationWithString()
    {
        $this->distanceMatrixRequest->setDestinations(array('foo'));

        $this->assertTrue($this->distanceMatrixRequest->hasDestinations());
        $this->assertEquals($this->distanceMatrixRequest->getDestinations(), array('foo'));
    }

    public function testDestinationWithCoordinate()
    {
        $location = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->distanceMatrixRequest->setDestinations(array($location));

        $destinations = $this->distanceMatrixRequest->getDestinations();

        $this->assertArrayHasKey(0, $destinations);
        $this->assertCount(1, $destinations);
        $this->assertSame($location, $destinations[0]);
    }

    public function testDestinationWithLatitudeAndLongitude()
    {
        $this->distanceMatrixRequest->addDestination(1.1, 2.1, false);

        $destinations = $this->distanceMatrixRequest->getDestinations();

        $this->assertArrayHasKey(0, $destinations);
        $this->assertCount(1, $destinations);
        $this->assertSame(1.1, $destinations[0]->getLatitude());
        $this->assertSame(2.1, $destinations[0]->getLongitude());
        $this->assertFalse($destinations[0]->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The destination adder arguments are invalid.
     * The available prototypes are :
     * - function setDestination(string $destination)
     * - function setDestination(Ivory\GoogleMap\Base\Coordinate $destination)
     * - function setDestination(double $latitude, double $longitude, boolean $noWrap)
     */
    public function testDestinationWithInvalidValue()
    {
        $this->distanceMatrixRequest->addDestination(true);
    }

    public function testOriginWithString()
    {
        $this->distanceMatrixRequest->setOrigins(array('foo'));

        $this->assertTrue($this->distanceMatrixRequest->hasOrigins());
        $this->assertSame(array('foo'), $this->distanceMatrixRequest->getOrigins());
    }

    public function testOriginWithCoordinate()
    {
        $origin = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->distanceMatrixRequest->setOrigins(array($origin));

        $origins = $this->distanceMatrixRequest->getOrigins();

        $this->assertArrayHasKey(0, $origins);
        $this->assertSame($origin, $origins[0]);
    }

    public function testOriginWithLatitudeAndLongitude()
    {
        $this->distanceMatrixRequest->addOrigin(1.1, 2.1, false);

        $origins = $this->distanceMatrixRequest->getOrigins();

        $this->assertArrayHasKey(0, $origins);
        $this->assertCount(1, $origins);
        $this->assertSame(1.1, $origins[0]->getLatitude());
        $this->assertSame(2.1, $origins[0]->getLongitude());
        $this->assertFalse($origins[0]->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The origin adder arguments are invalid.
     * The available prototypes are :
     * - function setOrigin(string $origin)
     * - function setOrigin(Ivory\GoogleMap\Base\Coordinate $origin)
     * - function setOrigin(double $latitude, double $longitude, boolean $noWrap)
     */
    public function testOriginWithInvalidValue()
    {
        $this->distanceMatrixRequest->addOrigin(true);
    }

    public function testRegionWithValidValue()
    {
        $this->distanceMatrixRequest->setRegion('fr');

        $this->assertTrue($this->distanceMatrixRequest->hasRegion());
        $this->assertSame('fr', $this->distanceMatrixRequest->getRegion());
    }

    public function testRegionWithNullValue()
    {
        $this->distanceMatrixRequest->setRegion('fr');
        $this->distanceMatrixRequest->setRegion(null);

        $this->assertNull($this->distanceMatrixRequest->getRegion());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request region must be a string with two characters.
     */
    public function testRegionWithInvalidValue()
    {
        $this->distanceMatrixRequest->setRegion('foo');
    }

    public function testLanguageWithValidValue()
    {
        $this->distanceMatrixRequest->setLanguage('fr');

        $this->assertTrue($this->distanceMatrixRequest->hasLanguage());
        $this->assertSame('fr', $this->distanceMatrixRequest->getLanguage());
    }

    public function testLanguageWithNullValue()
    {
        $this->distanceMatrixRequest->setLanguage('fr');
        $this->distanceMatrixRequest->setLanguage(null);

        $this->assertNull($this->distanceMatrixRequest->getLanguage());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request language must be a string with two characters.
     */
    public function testLanguageWithInvalidValue()
    {
        $this->distanceMatrixRequest->setLanguage('foo');
    }

    public function testTravelModeWithValidValue()
    {
        $this->distanceMatrixRequest->setTravelMode(TravelMode::WALKING);

        $this->assertTrue($this->distanceMatrixRequest->hasTravelMode());
        $this->assertSame(TravelMode::WALKING, $this->distanceMatrixRequest->getTravelMode());
    }

    public function testTravelModeWithNullValue()
    {
        $this->distanceMatrixRequest->setTravelMode(TravelMode::WALKING);
        $this->distanceMatrixRequest->setTravelMode(null);

        $this->assertNull($this->distanceMatrixRequest->getTravelMode());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request travel mode can only be : BICYCLING, DRIVING, WALKING.
     */
    public function testTravelModeWithTransitValue()
    {
        $this->distanceMatrixRequest->setTravelMode(TravelMode::TRANSIT);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request travel mode can only be : BICYCLING, DRIVING, WALKING.
     */
    public function testTravelModeWithInvalidValue()
    {
        $this->distanceMatrixRequest->setTravelMode('foo');
    }

    public function testUnitSystemWithValidValue()
    {
        $this->distanceMatrixRequest->setUnitSystem(UnitSystem::IMPERIAL);

        $this->assertTrue($this->distanceMatrixRequest->hasUnitSystem());
        $this->assertSame(UnitSystem::IMPERIAL, $this->distanceMatrixRequest->getUnitSystem());
    }

    public function testUnitSystemWithNullValue()
    {
        $this->distanceMatrixRequest->setUnitSystem(UnitSystem::IMPERIAL);
        $this->distanceMatrixRequest->setUnitSystem(null);

        $this->assertNull($this->distanceMatrixRequest->getUnitSystem());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request unit system can only be : IMPERIAL, METRIC.
     */
    public function testUnitSystemWithInvalidValue()
    {
        $this->distanceMatrixRequest->setUnitSystem('foo');
    }

    public function testSensorWithValidValue()
    {
        $this->distanceMatrixRequest->setSensor(true);

        $this->assertTrue($this->distanceMatrixRequest->hasSensor());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix request sensor flag must be a boolean value.
     */
    public function testSensorWithInvalidValue()
    {
        $this->distanceMatrixRequest->setSensor('foo');
    }

    public function testIsValid()
    {
        $this->assertFalse($this->distanceMatrixRequest->isValid());
    }

    public function testIsValidWithOrigin()
    {
        $this->distanceMatrixRequest->addOrigin('foo');

        $this->assertFalse($this->distanceMatrixRequest->isValid());
    }

    public function testIsValidWithDestination()
    {
        $this->distanceMatrixRequest->addDestination('foo');

        $this->assertFalse($this->distanceMatrixRequest->isValid());
    }

    public function testIsValidWithOriginAndDestination()
    {
        $this->distanceMatrixRequest->addDestination('foo');
        $this->distanceMatrixRequest->addOrigin('bar');

        $this->assertTrue($this->distanceMatrixRequest->isValid());
    }
}
