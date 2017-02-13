<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Request;

use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Base\TrafficModel;
use Ivory\GoogleMap\Service\Base\TransitMode;
use Ivory\GoogleMap\Service\Base\TransitRoutingPreference;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <gelon.eric@gmail.com>
 */
class DirectionRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionRequest
     */
    private $request;

    /**
     * @var LocationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $origin;

    /**
     * @var LocationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $destination;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectionRequest(
            $this->origin = $this->createLocationMock('origin'),
            $this->destination = $this->createLocationMock('destination')
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(DirectionRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->origin, $this->request->getOrigin());
        $this->assertSame($this->destination, $this->request->getDestination());
        $this->assertFalse($this->request->hasDepartureTime());
        $this->assertNull($this->request->getDepartureTime());
        $this->assertFalse($this->request->hasArrivalTime());
        $this->assertNull($this->request->getArrivalTime());
        $this->assertFalse($this->request->hasWaypoints());
        $this->assertEmpty($this->request->getWaypoints());
        $this->assertFalse($this->request->hasOptimizeWaypoints());
        $this->assertNull($this->request->getOptimizeWaypoints());
        $this->assertFalse($this->request->hasTravelMode());
        $this->assertNull($this->request->getTravelMode());
        $this->assertFalse($this->request->hasAvoid());
        $this->assertNull($this->request->getAvoid());
        $this->assertFalse($this->request->hasProvideRouteAlternatives());
        $this->assertNull($this->request->getProvideRouteAlternatives());
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

    public function testOrigin()
    {
        $this->request->setOrigin($origin = $this->createLocationMock());

        $this->assertSame($origin, $this->request->getOrigin());
    }

    public function testDestination()
    {
        $this->request->setDestination($destination = $this->createLocationMock());

        $this->assertSame($destination, $this->request->getDestination());
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

    public function testResetArrivalTime()
    {
        $this->request->setArrivalTime(new \DateTime());
        $this->request->setArrivalTime(null);

        $this->assertFalse($this->request->hasArrivalTime());
        $this->assertNull($this->request->getArrivalTime());
    }

    public function testSetWaypoints()
    {
        $this->request->setWaypoints($waypoints = [$waypoint = $this->createWaypointMock()]);
        $this->request->setWaypoints($waypoints);

        $this->assertTrue($this->request->hasWaypoints());
        $this->assertTrue($this->request->hasWaypoint($waypoint));
        $this->assertSame($waypoints, $this->request->getWaypoints());
    }

    public function testAddWaypoints()
    {
        $this->request->setWaypoints($firstWaypoints = [$this->createWaypointMock()]);
        $this->request->addWaypoints($secondWaypoints = [$this->createWaypointMock()]);

        $this->assertTrue($this->request->hasWaypoints());
        $this->assertSame(array_merge($firstWaypoints, $secondWaypoints), $this->request->getWaypoints());
    }

    public function testAddWaypoint()
    {
        $this->request->addWaypoint($waypoint = $this->createWaypointMock());

        $this->assertTrue($this->request->hasWaypoints());
        $this->assertTrue($this->request->hasWaypoint($waypoint));
        $this->assertSame([$waypoint], $this->request->getWaypoints());
    }

    public function testRemoveWaypoint()
    {
        $this->request->addWaypoint($waypoint = $this->createWaypointMock());
        $this->request->removeWaypoint($waypoint);

        $this->assertFalse($this->request->hasWaypoints());
        $this->assertFalse($this->request->hasWaypoint($waypoint));
        $this->assertEmpty($this->request->getWaypoints());
    }

    public function testOptimizeWaypoints()
    {
        $this->request->setOptimizeWaypoints(true);

        $this->assertTrue($this->request->hasOptimizeWaypoints());
        $this->assertTrue($this->request->getOptimizeWaypoints());
    }

    public function testResetOptimizeWaypoints()
    {
        $this->request->setOptimizeWaypoints(true);
        $this->request->setOptimizeWaypoints(null);

        $this->assertFalse($this->request->hasOptimizeWaypoints());
        $this->assertNull($this->request->getOptimizeWaypoints());
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

    public function testProvideRouteAlternatives()
    {
        $this->request->setProvideRouteAlternatives(true);

        $this->assertTrue($this->request->hasProvideRouteAlternatives());
        $this->assertTrue($this->request->getProvideRouteAlternatives());
    }

    public function testResetProvideRouteAlternatives()
    {
        $this->request->setProvideRouteAlternatives(true);
        $this->request->setProvideRouteAlternatives(null);

        $this->assertFalse($this->request->hasProvideRouteAlternatives());
        $this->assertNull($this->request->getProvideRouteAlternatives());
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

    public function testBuildQueryWithWaypoints()
    {
        $firstWaypoint = $this->createWaypointMock();
        $firstWaypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(false));

        $firstWaypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($firstLocation = $this->createLocationMock($firstLocationBuilt = 'first')));

        $secondWaypoint = $this->createWaypointMock();
        $secondWaypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(true));

        $secondWaypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($secondLocation = $this->createLocationMock($secondLocationBuilt = 'second')));

        $this->request->addWaypoints([$firstWaypoint, $secondWaypoint]);

        $this->assertBuild($this->request->buildQuery(), ['waypoints' => $firstLocationBuilt.'|via:'.$secondLocationBuilt]);
    }

    public function testBuildQueryWithOptimizedWaypoints()
    {
        $waypoint = $this->createWaypointMock();
        $waypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(false));

        $waypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($location = $this->createLocationMock($locationBuilt = 'location')));

        $this->request->setOptimizeWaypoints(true);
        $this->request->addWaypoint($waypoint);

        $this->assertBuild($this->request->buildQuery(), ['waypoints' => 'optimize:true|'.$locationBuilt]);
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

    public function testBuildQueryWithAlternatives()
    {
        $this->request->setProvideRouteAlternatives(true);

        $this->assertBuild($this->request->buildQuery(), ['alternatives' => 'true']);
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

    public function testBuildQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertBuild($this->request->buildQuery(), ['region' => $region]);
    }

    public function testBuildQueryWithUnitSystem()
    {
        $this->request->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertBuild($this->request->buildQuery(), ['units' => strtolower($unitSystem)]);
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
        $this->assertSame(array_merge([
            'origin'      => 'origin',
            'destination' => 'destination',
        ], $expected), $actual);
    }

    /**
     * @param string $value
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|LocationInterface
     */
    private function createLocationMock($value = 'value')
    {
        $location = $this->createMock(LocationInterface::class);
        $location
            ->expects($this->any())
            ->method('buildQuery')
            ->will($this->returnValue($value));

        return $location;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionWaypoint
     */
    private function createWaypointMock()
    {
        return $this->createMock(DirectionWaypoint::class);
    }
}
