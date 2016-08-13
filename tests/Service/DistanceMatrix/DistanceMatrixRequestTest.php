<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix;

use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixAvoid;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixRequest;

/**
 * @author GeLo <gelon.eric@gmail.com>
 */
class DistanceMatrixRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DistanceMatrixRequest
     */
    private $request;

    /**
     * @var string[]
     */
    private $origins;

    /**
     * @var string[]
     */
    private $destinations;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DistanceMatrixRequest(
            $this->origins = ['Paris'],
            $this->destinations = ['Lille']
        );
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->request->hasOrigins());
        $this->assertSame($this->origins, $this->request->getOrigins());
        $this->assertTrue($this->request->hasDestinations());
        $this->assertSame($this->destinations, $this->request->getDestinations());
        $this->assertFalse($this->request->hasDepartureTime());
        $this->assertNull($this->request->getDepartureTime());
        $this->assertFalse($this->request->hasArrivalTime());
        $this->assertNull($this->request->getArrivalTime());
        $this->assertFalse($this->request->hasTravelMode());
        $this->assertNull($this->request->getTravelMode());
        $this->assertFalse($this->request->hasAvoid());
        $this->assertNull($this->request->getAvoid());
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
        $this->assertFalse($this->request->hasUnitSystem());
        $this->assertNull($this->request->getUnitSystem());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testSetOrigins()
    {
        $this->request->setOrigins($origins = [$origin = 'Paris']);
        $this->request->setOrigins($origins);

        $this->assertTrue($this->request->hasOrigins());
        $this->assertTrue($this->request->hasOrigin($origin));
        $this->assertSame($origins, $this->request->getOrigins());
    }

    public function testAddOrigins()
    {
        $this->request->setOrigins($firstOrigins = ['Paris']);
        $this->request->addOrigins($secondOrigins = ['Lille']);

        $this->assertTrue($this->request->hasOrigins());
        $this->assertSame(array_merge($firstOrigins, $secondOrigins), $this->request->getOrigins());
    }

    public function testAddOrigin()
    {
        $this->request->addOrigin($origin = 'Paris');

        $this->assertTrue($this->request->hasOrigins());
        $this->assertTrue($this->request->hasOrigin($origin));
        $this->assertSame([$origin], $this->request->getOrigins());
    }

    public function testRemoveOrigin()
    {
        $this->request->addOrigin($origin = 'Paris');
        $this->request->removeOrigin($origin);

        $this->assertFalse($this->request->hasOrigins());
        $this->assertFalse($this->request->hasOrigin($origin));
        $this->assertEmpty($this->request->getOrigins());
    }

    public function testSetDestinations()
    {
        $this->request->setDestinations($destinations = [$destination = 'Paris']);
        $this->request->setDestinations($destinations);

        $this->assertTrue($this->request->hasDestinations());
        $this->assertTrue($this->request->hasDestination($destination));
        $this->assertSame($destinations, $this->request->getDestinations());
    }

    public function testAddDestinations()
    {
        $this->request->setDestinations($firstDestinations = ['Paris']);
        $this->request->addDestinations($secondDestinations = ['Lille']);

        $this->assertTrue($this->request->hasDestinations());
        $this->assertSame(array_merge($firstDestinations, $secondDestinations), $this->request->getDestinations());
    }

    public function testAddDestination()
    {
        $this->request->addDestination($destination = 'Paris');

        $this->assertTrue($this->request->hasDestinations());
        $this->assertTrue($this->request->hasDestination($destination));
        $this->assertSame(array_merge($this->destinations, [$destination]), $this->request->getDestinations());
    }

    public function testRemoveDestination()
    {
        $this->request->addDestination($destination = 'Paris');
        $this->request->removeDestination($destination);

        $this->assertTrue($this->request->hasDestinations());
        $this->assertFalse($this->request->hasDestination($destination));
        $this->assertSame($this->destinations, $this->request->getDestinations());
    }

    public function testDepartureTime()
    {
        $this->request->setDepartureTime($departureTime = new \DateTime());

        $this->assertTrue($this->request->hasDepartureTime());
        $this->assertSame($departureTime, $this->request->getDepartureTime());
    }

    public function testResetDepartureTime()
    {
        $this->request->setDepartureTime(new \DateTime());
        $this->request->setDepartureTime(null);

        $this->assertFalse($this->request->hasDepartureTime());
        $this->assertNull($this->request->getDepartureTime());
    }

    public function testArrivalTime()
    {
        $this->request->setArrivalTime($arrivalTime = new \DateTime());

        $this->assertTrue($this->request->hasArrivalTime());
        $this->assertSame($arrivalTime, $this->request->getArrivalTime());
    }

    public function testArrivalTimeWithNullValue()
    {
        $this->request->setArrivalTime(new \DateTime());
        $this->request->setArrivalTime(null);

        $this->assertFalse($this->request->hasArrivalTime());
        $this->assertNull($this->request->getArrivalTime());
    }

    public function testTravelMode()
    {
        $this->request->setTravelMode($travelMode = TravelMode::WALKING);

        $this->assertTrue($this->request->hasTravelMode());
        $this->assertSame($travelMode, $this->request->getTravelMode());
    }

    public function testResetTravelMode()
    {
        $this->request->setTravelMode(TravelMode::WALKING);
        $this->request->setTravelMode(null);

        $this->assertFalse($this->request->hasTravelMode());
        $this->assertNull($this->request->getTravelMode());
    }

    public function testAvoid()
    {
        $this->request->setAvoid($avoid = DistanceMatrixAvoid::HIGHWAYS);

        $this->assertTrue($this->request->hasAvoid());
        $this->assertSame($avoid, $this->request->getAvoid());
    }

    public function testResetAvoid()
    {
        $this->request->setAvoid(DistanceMatrixAvoid::HIGHWAYS);
        $this->request->setAvoid(null);

        $this->assertFalse($this->request->hasAvoid());
        $this->assertNull($this->request->getAvoid());
    }

    public function testRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertTrue($this->request->hasRegion());
        $this->assertSame($region, $this->request->getRegion());
    }

    public function testResetRegion()
    {
        $this->request->setRegion('fr');
        $this->request->setRegion(null);

        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
    }

    public function testUnitSystem()
    {
        $this->request->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertTrue($this->request->hasUnitSystem());
        $this->assertSame($unitSystem, $this->request->getUnitSystem());
    }

    public function testResetUnitSystem()
    {
        $this->request->setUnitSystem(UnitSystem::IMPERIAL);
        $this->request->setUnitSystem(null);

        $this->assertFalse($this->request->hasUnitSystem());
        $this->assertNull($this->request->getUnitSystem());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->request->setLanguage('fr');
        $this->request->setLanguage(null);

        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testQuery()
    {
        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
        ], $this->request->buildQuery());
    }

    public function testQueryWithDepartureTime()
    {
        $this->request->setDepartureTime($departureTime = new \DateTime());

        $this->assertSame([
            'origins'        => implode('|', $this->origins),
            'destinations'   => implode('|', $this->destinations),
            'departure_time' => $departureTime->getTimestamp(),
        ], $this->request->buildQuery());
    }

    public function testQueryWithArrivalTime()
    {
        $this->request->setArrivalTime($arrivalTime = new \DateTime());

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'arrival_time' => $arrivalTime->getTimestamp(),
        ], $this->request->buildQuery());
    }

    public function testQueryWithTravelMode()
    {
        $this->request->setTravelMode($travelMode = TravelMode::BICYCLING);

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'mode'         => strtolower($travelMode),
        ], $this->request->buildQuery());
    }

    public function testQueryWithAvoid()
    {
        $this->request->setAvoid($avoid = DistanceMatrixAvoid::HIGHWAYS);

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'avoid'        => $avoid,
        ], $this->request->buildQuery());
    }

    public function testQueryWithUnitSystem()
    {
        $this->request->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'units'        => strtolower($unitSystem),
        ], $this->request->buildQuery());
    }

    public function testQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'region'       => $region,
        ], $this->request->buildQuery());
    }

    public function testQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'origins'      => implode('|', $this->origins),
            'destinations' => implode('|', $this->destinations),
            'language'     => $language,
        ], $this->request->buildQuery());
    }
}
