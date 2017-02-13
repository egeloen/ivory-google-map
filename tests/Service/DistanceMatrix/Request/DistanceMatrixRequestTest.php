<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix\Request;

use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Base\TrafficModel;
use Ivory\GoogleMap\Service\Base\TransitMode;
use Ivory\GoogleMap\Service\Base\TransitRoutingPreference;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Ivory\GoogleMap\Service\RequestInterface;

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
            $this->origins = [new AddressLocation('Paris')],
            $this->destinations = [new AddressLocation('Lille')]
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(DistanceMatrixRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
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
        $this->assertFalse($this->request->hasTrafficModel());
        $this->assertNull($this->request->getTrafficModel());
        $this->assertFalse($this->request->hasTransitModes());
        $this->assertEmpty($this->request->getTransitModes());
        $this->assertFalse($this->request->hasTransitRoutingPreference());
        $this->assertNull($this->request->getTransitRoutingPreference());
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
        $this->assertFalse($this->request->hasUnitSystem());
        $this->assertNull($this->request->getUnitSystem());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testSetOrigins()
    {
        $this->request->setOrigins($origins = [$origin = new AddressLocation('Paris')]);
        $this->request->setOrigins($origins);

        $this->assertTrue($this->request->hasOrigins());
        $this->assertTrue($this->request->hasOrigin($origin));
        $this->assertSame($origins, $this->request->getOrigins());
    }

    public function testAddOrigins()
    {
        $this->request->setOrigins($firstOrigins = [new AddressLocation('Paris')]);
        $this->request->addOrigins($secondOrigins = [new AddressLocation('Lille')]);

        $this->assertTrue($this->request->hasOrigins());
        $this->assertSame(array_merge($firstOrigins, $secondOrigins), $this->request->getOrigins());
    }

    public function testAddOrigin()
    {
        $this->request->addOrigin($origin = new AddressLocation('Paris'));

        $this->assertTrue($this->request->hasOrigins());
        $this->assertTrue($this->request->hasOrigin($origin));
        $this->assertSame(array_merge($this->origins, [$origin]), $this->request->getOrigins());
    }

    public function testRemoveOrigin()
    {
        $this->request->addOrigin($origin = new AddressLocation('Paris'));
        $this->request->removeOrigin($origin);

        $this->assertTrue($this->request->hasOrigins());
        $this->assertFalse($this->request->hasOrigin($origin));
        $this->assertSame($this->origins, $this->request->getOrigins());
    }

    public function testSetDestinations()
    {
        $this->request->setDestinations($destinations = [$destination = new AddressLocation('Paris')]);
        $this->request->setDestinations($destinations);

        $this->assertTrue($this->request->hasDestinations());
        $this->assertTrue($this->request->hasDestination($destination));
        $this->assertSame($destinations, $this->request->getDestinations());
    }

    public function testAddDestinations()
    {
        $this->request->setDestinations($firstDestinations = [new AddressLocation('Paris')]);
        $this->request->addDestinations($secondDestinations = [new AddressLocation('Lille')]);

        $this->assertTrue($this->request->hasDestinations());
        $this->assertSame(array_merge($firstDestinations, $secondDestinations), $this->request->getDestinations());
    }

    public function testAddDestination()
    {
        $this->request->addDestination($destination = new AddressLocation('Paris'));

        $this->assertTrue($this->request->hasDestinations());
        $this->assertTrue($this->request->hasDestination($destination));
        $this->assertSame(array_merge($this->destinations, [$destination]), $this->request->getDestinations());
    }

    public function testRemoveDestination()
    {
        $this->request->addDestination($destination = new AddressLocation('Paris'));
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
        $this->request->setAvoid($avoid = Avoid::HIGHWAYS);

        $this->assertTrue($this->request->hasAvoid());
        $this->assertSame($avoid, $this->request->getAvoid());
    }

    public function testResetAvoid()
    {
        $this->request->setAvoid(Avoid::HIGHWAYS);
        $this->request->setAvoid(null);

        $this->assertFalse($this->request->hasAvoid());
        $this->assertNull($this->request->getAvoid());
    }

    public function testTrafficModel()
    {
        $this->request->setTrafficModel($trafficModel = TrafficModel::BEST_GUESS);

        $this->assertTrue($this->request->hasTrafficModel());
        $this->assertSame($trafficModel, $this->request->getTrafficModel());
    }

    public function testResetTrafficModel()
    {
        $this->request->setTrafficModel(TrafficModel::BEST_GUESS);
        $this->request->setTrafficModel(null);

        $this->assertFalse($this->request->hasTrafficModel());
        $this->assertNull($this->request->getTrafficModel());
    }

    public function testSetTransitModes()
    {
        $this->request->setTransitModes($transitModes = [$transitMode = TransitMode::BUS]);
        $this->request->setTransitModes($transitModes);

        $this->assertTrue($this->request->hasTransitModes());
        $this->assertTrue($this->request->hasTransitMode($transitMode));
        $this->assertSame($transitModes, $this->request->getTransitModes());
    }

    public function testAddTransitModes()
    {
        $this->request->setTransitModes($firstTransitModes = [TransitMode::BUS]);
        $this->request->addTransitModes($secondTransitModes = [TransitMode::SUBWAY]);

        $this->assertTrue($this->request->hasTransitModes());
        $this->assertSame(array_merge($firstTransitModes, $secondTransitModes), $this->request->getTransitModes());
    }

    public function testAddTransitMode()
    {
        $this->request->addTransitMode($transitMode = TransitMode::BUS);

        $this->assertTrue($this->request->hasTransitModes());
        $this->assertTrue($this->request->hasTransitMode($transitMode));
        $this->assertSame([$transitMode], $this->request->getTransitModes());
    }

    public function testRemoveTransitMode()
    {
        $this->request->addTransitMode($transitMode = TransitMode::BUS);
        $this->request->removeTransitMode($transitMode);

        $this->assertFalse($this->request->hasTransitModes());
        $this->assertFalse($this->request->hasTransitMode($transitMode));
        $this->assertEmpty($this->request->getTransitModes());
    }

    public function testTransitRoutingPreference()
    {
        $transitRoutingPreference = TransitRoutingPreference::LESS_WALKING;
        $this->request->setTransitRoutingPreference($transitRoutingPreference);

        $this->assertTrue($this->request->hasTransitRoutingPreference());
        $this->assertSame($transitRoutingPreference, $this->request->getTransitRoutingPreference());
    }

    public function testResetTransitRoutingPreference()
    {
        $transitRoutingPreference = TransitRoutingPreference::LESS_WALKING;
        $this->request->setTransitRoutingPreference($transitRoutingPreference);
        $this->request->setTransitRoutingPreference(null);

        $this->assertFalse($this->request->hasTransitRoutingPreference());
        $this->assertNull($this->request->getTransitRoutingPreference());
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

    public function testBuildQuery()
    {
        $this->assertBuild($this->request->buildQuery());
    }

    public function testBuildQueryWithDepartureTime()
    {
        $this->request->setDepartureTime($departureTime = new \DateTime());

        $this->assertBuild($this->request->buildQuery(), ['departure_time' => $departureTime->getTimestamp()]);
    }

    public function testBuildQueryWithArrivalTime()
    {
        $this->request->setArrivalTime($arrivalTime = new \DateTime());

        $this->assertBuild($this->request->buildQuery(), ['arrival_time' => $arrivalTime->getTimestamp()]);
    }

    public function testBuildQueryWithTravelMode()
    {
        $this->request->setTravelMode($travelMode = TravelMode::BICYCLING);

        $this->assertBuild($this->request->buildQuery(), ['mode' => strtolower($travelMode)]);
    }

    public function testBuildQueryWithAvoid()
    {
        $this->request->setAvoid($avoid = Avoid::HIGHWAYS);

        $this->assertBuild($this->request->buildQuery(), ['avoid' => $avoid]);
    }

    public function testBuildQueryWithTrafficModel()
    {
        $this->request->setTrafficModel($trafficModel = TrafficModel::BEST_GUESS);

        $this->assertBuild($this->request->buildQuery(), ['traffic_model' => $trafficModel]);
    }

    public function testBuildQueryWithTransitModes()
    {
        $this->request->setTransitModes($transitModes = [TransitMode::BUS, TransitMode::SUBWAY]);

        $this->assertBuild($this->request->buildQuery(), ['transit_mode' => implode('|', $transitModes)]);
    }

    public function testBuildQueryWithTransitRoutingPreference()
    {
        $transitRoutingPreference = TransitRoutingPreference::LESS_WALKING;
        $this->request->setTransitRoutingPreference($transitRoutingPreference);

        $this->assertBuild($this->request->buildQuery(), ['transit_routing_preference' => $transitRoutingPreference]);
    }

    public function testBuildQueryWithUnitSystem()
    {
        $this->request->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertBuild($this->request->buildQuery(), ['units' => strtolower($unitSystem)]);
    }

    public function testBuildQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertBuild($this->request->buildQuery(), ['region' => $region]);
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertBuild($this->request->buildQuery(), ['language' => $language]);
    }

    /**
     * @param mixed[] $actual
     * @param mixed[] $expected
     */
    private function assertBuild($actual, array $expected = [])
    {
        $locationBuilder = function (LocationInterface $location) {
            return $location->buildQuery();
        };

        $this->assertSame(array_merge([
            'origins'      => implode('|', array_map($locationBuilder, $this->origins)),
            'destinations' => implode('|', array_map($locationBuilder, $this->destinations)),
        ], $expected), $actual);
    }
}
