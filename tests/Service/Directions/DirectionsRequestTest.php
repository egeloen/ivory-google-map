<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\Directions\DirectionsAvoid;
use Ivory\GoogleMap\Service\Directions\DirectionsRequest;
use Ivory\GoogleMap\Service\Directions\DirectionsWaypoint;

/**
 * @author GeLo <gelon.eric@gmail.com>
 */
class DirectionsRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionsRequest
     */
    private $request;

    /**
     * @var string
     */
    private $origin;

    /**
     * @var string
     */
    private $destination;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectionsRequest(
            $this->origin = 'Lille',
            $this->destination = 'Paris'
        );
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
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
        $this->assertFalse($this->request->hasUnitSystem());
        $this->assertNull($this->request->getUnitSystem());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    /**
     * @param Coordinate|string $origin
     *
     * @dataProvider originProvider
     */
    public function testOrigin($origin)
    {
        $this->request->setOrigin($origin);

        $this->assertSame($origin, $this->request->getOrigin());
    }

    /**
     * @param Coordinate|string $destination
     *
     * @dataProvider destinationProvider
     */
    public function testDestination($destination)
    {
        $this->request->setDestination($destination);

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

    public function testArrivalTimeWithNullValue()
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
        $this->request->setAvoid($avoid = DirectionsAvoid::HIGHWAYS);

        $this->assertTrue($this->request->hasAvoid());
        $this->assertSame($avoid, $this->request->getAvoid());
    }

    public function testResetAvoid()
    {
        $this->request->setAvoid(DirectionsAvoid::HIGHWAYS);
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
            'origin'      => $this->origin,
            'destination' => $this->destination,
        ], $this->request->buildQuery());
    }

    public function testQueryWithDepartureTime()
    {
        $this->request->setDepartureTime($departureTime = new \DateTime());

        $this->assertSame([
            'origin'         => $this->origin,
            'destination'    => $this->destination,
            'departure_time' => $departureTime->getTimestamp(),
        ], $this->request->buildQuery());
    }

    public function testQueryWithArrivalTime()
    {
        $this->request->setArrivalTime($arrivalTime = new \DateTime());

        $this->assertSame([
            'origin'       => $this->origin,
            'destination'  => $this->destination,
            'arrival_time' => $arrivalTime->getTimestamp(),
        ], $this->request->buildQuery());
    }

    public function testQueryWithWaypoints()
    {
        $firstWaypoint = $this->createWaypointMock();
        $firstWaypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(false));

        $firstWaypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($firstLocation = 'Compiègne'));

        $secondWaypoint = $this->createWaypointMock();
        $secondWaypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(true));

        $secondWaypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($secondLocation = $this->createCoordinateMock()));

        $secondLocation
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue($latitude = 50.103558));

        $secondLocation
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue($longitude = 2.849408));

        $this->request->addWaypoints([$firstWaypoint, $secondWaypoint]);

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'waypoints'   => $firstLocation.'|via:'.$latitude.','.$longitude,
        ], $this->request->buildQuery());
    }

    public function testQueryWithOptimizedWaypoints()
    {
        $waypoint = $this->createWaypointMock();
        $waypoint
            ->expects($this->once())
            ->method('getStopover')
            ->will($this->returnValue(false));

        $waypoint
            ->expects($this->once())
            ->method('getLocation')
            ->will($this->returnValue($location = 'Compiègne'));

        $this->request->setOptimizeWaypoints(true);
        $this->request->addWaypoint($waypoint);

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'waypoints'   => 'optimize:true|'.$location,
        ], $this->request->buildQuery());
    }

    public function testQueryWithTravelMode()
    {
        $this->request->setTravelMode($travelMode = TravelMode::BICYCLING);

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'mode'        => strtolower($travelMode),
        ], $this->request->buildQuery());
    }

    public function testQueryWithAvoid()
    {
        $this->request->setAvoid($avoid = DirectionsAvoid::HIGHWAYS);

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'avoid'       => $avoid,
        ], $this->request->buildQuery());
    }

    public function testQueryWithAlternatives()
    {
        $this->request->setProvideRouteAlternatives(true);

        $this->assertSame([
            'origin'       => $this->origin,
            'destination'  => $this->destination,
            'alternatives' => 'true',
        ], $this->request->buildQuery());
    }

    public function testQueryWithRegion()
    {
        $this->request->setRegion($region = 'fr');

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'region'      => $region,
        ], $this->request->buildQuery());
    }

    public function testQueryWithUnitSystem()
    {
        $this->request->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'units'       => strtolower($unitSystem),
        ], $this->request->buildQuery());
    }

    public function testQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'origin'      => $this->origin,
            'destination' => $this->destination,
            'language'    => $language,
        ], $this->request->buildQuery());
    }

    /**
     * @return mixed[][]
     */
    public function originProvider()
    {
        return [
            ['Paris'],
            [$this->createCoordinateMock()],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function destinationProvider()
    {
        return [
            ['Paris'],
            [$this->createCoordinateMock()],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionsWaypoint
     */
    private function createWaypointMock()
    {
        return $this->createMock(DirectionsWaypoint::class);
    }
}
