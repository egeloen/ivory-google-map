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
 * Distance matrix request test.
 *
 * @author GeLo <gelon.eric@gmail.com>
 */
class DistanceMatrixRequestTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest */
    private $distanceMatrixRequest;

    /** @var array */
    private $origins;

    /** @var array */
    private $destinations;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixRequest = new DistanceMatrixRequest(
            $this->origins = array('origin'),
            $this->destinations = array('destination')
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->destinations);
        unset($this->origins);
        unset($this->distanceMatrixRequest);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->distanceMatrixRequest->hasOrigins());
        $this->assertSame($this->origins, $this->distanceMatrixRequest->getOrigins());

        $this->assertTrue($this->distanceMatrixRequest->hasDestinations());
        $this->assertSame($this->destinations, $this->distanceMatrixRequest->getDestinations());

        $this->assertFalse($this->distanceMatrixRequest->hasAvoidHighways());
        $this->assertFalse($this->distanceMatrixRequest->hasAvoidTolls());
        $this->assertFalse($this->distanceMatrixRequest->hasRegion());
        $this->assertFalse($this->distanceMatrixRequest->hasLanguage());
        $this->assertFalse($this->distanceMatrixRequest->hasTravelMode());
        $this->assertFalse($this->distanceMatrixRequest->hasUnitSystem());
        $this->assertFalse($this->distanceMatrixRequest->hasSensor());
    }

    public function testSetAvoidHightways()
    {
        $this->distanceMatrixRequest->setAvoidHighways(true);

        $this->assertTrue($this->distanceMatrixRequest->hasAvoidHighways());
        $this->assertTrue($this->distanceMatrixRequest->getAvoidHighways());
    }

    public function testResetAvoidHighways()
    {
        $this->distanceMatrixRequest->setAvoidHighways(true);
        $this->distanceMatrixRequest->setAvoidHighways(null);

        $this->assertFalse($this->distanceMatrixRequest->hasAvoidHighways());
        $this->assertNull($this->distanceMatrixRequest->getAvoidHighways());
    }

    public function testSetAvoidTolls()
    {
        $this->distanceMatrixRequest->setAvoidTolls(true);

        $this->assertTrue($this->distanceMatrixRequest->hasAvoidTolls());
        $this->assertTrue($this->distanceMatrixRequest->getAvoidTolls());
    }

    public function testResetAvoidTolls()
    {
        $this->distanceMatrixRequest->setAvoidTolls(true);
        $this->distanceMatrixRequest->setAvoidTolls(null);

        $this->assertFalse($this->distanceMatrixRequest->hasAvoidTolls());
        $this->assertNull($this->distanceMatrixRequest->getAvoidTolls());
    }

    /**
     * @dataProvider locationProvider
     */
    public function testSetDestinations($destination)
    {
        $this->distanceMatrixRequest->setDestinations($destinations = array($destination));

        $this->assertDestinations($destinations);
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddDestinations($destination)
    {
        $this->distanceMatrixRequest->setDestinations($destinations = array($destination));
        $this->distanceMatrixRequest->addDestinations($newDestinations = array('bar'));

        $this->assertDestinations(array_merge($destinations, $newDestinations));
    }

    /**
     * @dataProvider locationProvider
     */
    public function testRemoveDestinations($destination)
    {
        $this->distanceMatrixRequest->setDestinations($destinations = array($destination));
        $this->distanceMatrixRequest->removeDestinations($destinations);

        $this->assertNoDestinations();
    }

    /**
     * @dataProvider locationProvider
     */
    public function testResetDestinations($destination)
    {
        $this->distanceMatrixRequest->setDestinations(array($destination));
        $this->distanceMatrixRequest->resetDestinations();

        $this->assertNoDestinations();
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddDestination($destination)
    {
        $this->distanceMatrixRequest->addDestination($destination);

        $this->assertDestination($destination);
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddDestinationUnicity($destination)
    {
        $this->distanceMatrixRequest->resetDestinations();
        $this->distanceMatrixRequest->addDestination($destination);
        $this->distanceMatrixRequest->addDestination($destination);

        $this->assertDestinations(array($destination));
    }

    /**
     * @dataProvider locationProvider
     */
    public function testRemoveDestination($destination)
    {
        $this->distanceMatrixRequest->addDestination($destination);
        $this->distanceMatrixRequest->removeDestination($destination);

        $this->assertNoDestination($destination);
    }

    /**
     * @dataProvider locationProvider
     */
    public function testSetOrigins($destination)
    {
        $this->distanceMatrixRequest->setOrigins($origins = array($destination));

        $this->assertOrigins($origins);
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddOrigins($destination)
    {
        $this->distanceMatrixRequest->setOrigins($origins = array($destination));
        $this->distanceMatrixRequest->addOrigins($newOrigins = array('bar'));

        $this->assertOrigins(array_merge($origins, $newOrigins));
    }

    /**
     * @dataProvider locationProvider
     */
    public function testRemoveOrigins($destination)
    {
        $this->distanceMatrixRequest->setOrigins($origins = array($destination));
        $this->distanceMatrixRequest->removeOrigins($origins);

        $this->assertNoOrigins();
    }

    /**
     * @dataProvider locationProvider
     */
    public function testResetOrigins($origin)
    {
        $this->distanceMatrixRequest->setOrigins(array($origin));
        $this->distanceMatrixRequest->resetOrigins();

        $this->assertNoOrigins();
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddOrigin($origin)
    {
        $this->distanceMatrixRequest->addOrigin($origin);

        $this->assertOrigin($origin);
    }

    /**
     * @dataProvider locationProvider
     */
    public function testAddOriginUnicity($origin)
    {
        $this->distanceMatrixRequest->resetOrigins();
        $this->distanceMatrixRequest->addOrigin($origin);
        $this->distanceMatrixRequest->addOrigin($origin);

        $this->assertOrigins(array($origin));
    }

    /**
     * @dataProvider locationProvider
     */
    public function testRemoveOrigin($origin)
    {
        $this->distanceMatrixRequest->addOrigin($origin);
        $this->distanceMatrixRequest->removeOrigin($origin);

        $this->assertNoOrigin($origin);
    }

    public function testSetRegion()
    {
        $this->distanceMatrixRequest->setRegion($region = 'fr');

        $this->assertTrue($this->distanceMatrixRequest->hasRegion());
        $this->assertSame($region, $this->distanceMatrixRequest->getRegion());
    }

    public function testResetRegion()
    {
        $this->distanceMatrixRequest->setRegion('fr');
        $this->distanceMatrixRequest->setRegion(null);

        $this->assertFalse($this->distanceMatrixRequest->hasRegion());
        $this->assertNull($this->distanceMatrixRequest->getRegion());
    }

    public function testSetLanguage()
    {
        $this->distanceMatrixRequest->setLanguage($language = 'fr');

        $this->assertTrue($this->distanceMatrixRequest->hasLanguage());
        $this->assertSame($language, $this->distanceMatrixRequest->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->distanceMatrixRequest->setLanguage('fr');
        $this->distanceMatrixRequest->setLanguage(null);

        $this->assertFalse($this->distanceMatrixRequest->hasLanguage());
        $this->assertNull($this->distanceMatrixRequest->getLanguage());
    }

    public function testSetTravelMode()
    {
        $this->distanceMatrixRequest->setTravelMode($travelMode = TravelMode::WALKING);

        $this->assertTrue($this->distanceMatrixRequest->hasTravelMode());
        $this->assertSame($travelMode, $this->distanceMatrixRequest->getTravelMode());
    }

    public function testResetTravelMode()
    {
        $this->distanceMatrixRequest->setTravelMode(TravelMode::WALKING);
        $this->distanceMatrixRequest->setTravelMode(null);

        $this->assertFalse($this->distanceMatrixRequest->hasTravelMode());
        $this->assertNull($this->distanceMatrixRequest->getTravelMode());
    }

    public function testSetUnitSystem()
    {
        $this->distanceMatrixRequest->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertTrue($this->distanceMatrixRequest->hasUnitSystem());
        $this->assertSame($unitSystem, $this->distanceMatrixRequest->getUnitSystem());
    }

    public function testResetUnitSystem()
    {
        $this->distanceMatrixRequest->setUnitSystem(UnitSystem::IMPERIAL);
        $this->distanceMatrixRequest->setUnitSystem(null);

        $this->assertFalse($this->distanceMatrixRequest->hasUnitSystem());
        $this->assertNull($this->distanceMatrixRequest->getUnitSystem());
    }

    public function testSetSensor()
    {
        $this->distanceMatrixRequest->setSensor(true);

        $this->assertTrue($this->distanceMatrixRequest->hasSensor());
    }

    /**
     * Gets the location provider.
     *
     * @return array The location provider.
     */
    public function locationProvider()
    {
        return array(
            array('foo'),
            array($this->createCoordinateMock()),
        );
    }

    /**
     * Asserts there are destinations.
     *
     * @param array $destinations The destinations.
     */
    private function assertDestinations($destinations)
    {
        $this->assertInternalType('array', $destinations);

        $this->assertTrue($this->distanceMatrixRequest->hasDestinations());
        $this->assertSame($destinations, $this->distanceMatrixRequest->getDestinations());

        foreach ($destinations as $destination) {
            $this->assertDestination($destination);
        }
    }

    /**
     * Asserts there is a destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    private function assertDestination($destination)
    {
        if (!is_string($destination)) {
            $this->assertCoordinateInstance($destination);
        }

        $this->assertTrue($this->distanceMatrixRequest->hasDestination($destination));
    }

    /**
     * Asserts there are no destinations.
     */
    private function assertNoDestinations()
    {
        $this->assertFalse($this->distanceMatrixRequest->hasDestinations());
        $this->assertEmpty($this->distanceMatrixRequest->getDestinations());
    }

    /**
     * Asserts there is no destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    private function assertNoDestination($destination)
    {
        if (!is_string($destination)) {
            $this->assertCoordinateInstance($destination);
        }

        $this->assertFalse($this->distanceMatrixRequest->hasDestination($destination));
    }

    /**
     * Asserts there are origins.
     *
     * @param array $origins The origins.
     */
    private function assertOrigins($origins)
    {
        $this->assertInternalType('array', $origins);

        $this->assertTrue($this->distanceMatrixRequest->hasOrigins());
        $this->assertSame($origins, $this->distanceMatrixRequest->getOrigins());

        foreach ($origins as $origin) {
            $this->assertOrigin($origin);
        }
    }

    /**
     * Asserts there is a origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     */
    private function assertOrigin($origin)
    {
        if (!is_string($origin)) {
            $this->assertCoordinateInstance($origin);
        }

        $this->assertTrue($this->distanceMatrixRequest->hasOrigin($origin));
    }

    /**
     * Asserts there are no origins.
     */
    private function assertNoOrigins()
    {
        $this->assertFalse($this->distanceMatrixRequest->hasOrigins());
        $this->assertEmpty($this->distanceMatrixRequest->getOrigins());
    }

    /**
     * Asserts there is no origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     */
    private function assertNoOrigin($origin)
    {
        if (!is_string($origin)) {
            $this->assertCoordinateInstance($origin);
        }

        $this->assertFalse($this->distanceMatrixRequest->hasOrigin($origin));
    }
}
