<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Services\Directions\DirectionsRoute;

/**
 * Directions route test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRouteTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsRoute */
    private $directionsRoute;

    /** @var \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject */
    private $bound;

    /** @var string */
    private $copyrights;

    /** @var array */
    private $legs;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline|\PHPUnit_Framework_MockObject_MockObject */
    private $encodedPolyline;

    /** @var string */
    private $summary;

    /** @var array */
    private $warnings;

    /** @var array */
    private $waypointOrders;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsRoute = new DirectionsRoute(
            $this->bound = $this->createBoundMock(),
            $this->copyrights = 'copyrights',
            $this->legs = array($leg = $this->createDirectionsLegMock()),
            $this->encodedPolyline = $this->createEncodedPolylineMock(),
            $this->summary = 'summary',
            $this->warnings = array('waypoint'),
            $this->waypointOrders = array(1)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsRoute);
        unset($this->bound);
        unset($this->copyrights);
        unset($this->legs);
        unset($this->encodedPolyline);
        unset($this->summary);
        unset($this->warnings);
        unset($this->waypointOrders);
    }

    public function testInitialState()
    {
        $this->assertSame($this->bound, $this->directionsRoute->getBound());
        $this->assertSame($this->copyrights, $this->directionsRoute->getCopyrights());
        $this->assertSame($this->legs, $this->directionsRoute->getLegs());
        $this->assertSame($this->encodedPolyline, $this->directionsRoute->getOverviewPolyline());
        $this->assertSame($this->summary, $this->directionsRoute->getSummary());
        $this->assertSame($this->warnings, $this->directionsRoute->getWarnings());
        $this->assertSame($this->waypointOrders, $this->directionsRoute->getWaypointOrders());
    }

    public function testSetBound()
    {
        $this->directionsRoute->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->directionsRoute->getBound());
    }

    public function testSetCopyrights()
    {
        $this->directionsRoute->setCopyrights($copyrights = 'foo');

        $this->assertSame($copyrights, $this->directionsRoute->getCopyrights());
    }

    public function testSetLegs()
    {
        $this->directionsRoute->setLegs($legs = array($this->createDirectionsLegMock()));

        $this->assertLegs($legs);
    }

    public function testAddLegs()
    {
        $this->directionsRoute->setLegs($legs = array($this->createDirectionsLegMock()));
        $this->directionsRoute->addLegs($newLegs = array($this->createDirectionsLegMock()));

        $this->assertLegs(array_merge($legs, $newLegs));
    }

    public function testRemoveLegs()
    {
        $this->directionsRoute->setLegs($legs = array($this->createDirectionsLegMock()));
        $this->directionsRoute->removeLegs($legs);

        $this->assertNoLegs();
    }

    public function testResetLegs()
    {
        $this->directionsRoute->setLegs(array($this->createDirectionsLegMock()));
        $this->directionsRoute->resetLegs();

        $this->assertNoLegs();
    }

    public function testAddLeg()
    {
        $this->directionsRoute->addLeg($leg = $this->createDirectionsLegMock());

        $this->assertLeg($leg);
    }

    public function testAddLegUnicity()
    {
        $this->directionsRoute->resetLegs();
        $this->directionsRoute->addLeg($leg = $this->createDirectionsLegMock());
        $this->directionsRoute->addLeg($leg);

        $this->assertLegs(array($leg));
    }

    public function testRemoveLeg()
    {
        $this->directionsRoute->addLeg($leg = $this->createDirectionsLegMock());
        $this->directionsRoute->removeLeg($leg);

        $this->assertNoLeg($leg);
    }

    public function testSetOverviewPolyline()
    {
        $this->directionsRoute->setOverviewPolyline($overviewPolyline = $this->createEncodedPolylineMock());

        $this->assertSame($overviewPolyline, $this->directionsRoute->getOverviewPolyline());
    }

    public function testSetSummary()
    {
        $this->directionsRoute->setSummary($summary = 'foo');

        $this->assertSame($summary, $this->directionsRoute->getSummary());
    }

    public function testSetWarnings()
    {
        $this->directionsRoute->setWarnings($warnings = array('foo'));

        $this->assertWarnings($warnings);
    }

    public function testAddWarnings()
    {
        $this->directionsRoute->setWarnings($warnings = array('foo'));
        $this->directionsRoute->addWarnings($newWarnings = array('bar'));

        $this->assertWarnings(array_merge($warnings, $newWarnings));
    }

    public function testRemoveWarnings()
    {
        $this->directionsRoute->setWarnings($warnings = array('foo'));
        $this->directionsRoute->removeWarnings($warnings);

        $this->assertNoWarnings();
    }

    public function testResetWarnings()
    {
        $this->directionsRoute->setWarnings(array('foo'));
        $this->directionsRoute->resetWarnings();

        $this->assertNoWarnings();
    }

    public function testAddWarning()
    {
        $this->directionsRoute->addWarning($warning = 'foo');

        $this->assertWarning($warning);
    }

    public function testAddWarningUnicity()
    {
        $this->directionsRoute->resetWarnings();
        $this->directionsRoute->addWarning($warning = 'foo');
        $this->directionsRoute->addWarning($warning);

        $this->assertWarnings(array($warning));
    }

    public function testRemoveWarning()
    {
        $this->directionsRoute->addWarning($warning = 'foo');
        $this->directionsRoute->removeWarning($warning);

        $this->assertNoWarning($warning);
    }

    public function testSetWaypointOrders()
    {
        $this->directionsRoute->setWaypointOrders($waypointOrders = array(1));

        $this->assertWaypointOrders($waypointOrders);
    }

    public function testAddWaypointOrders()
    {
        $this->directionsRoute->setWaypointOrders($waypointOrders = array('foo'));
        $this->directionsRoute->addWaypointOrders($newWaypointOrders = array('bar'));

        $this->assertWaypointOrders(array_merge($waypointOrders, $newWaypointOrders));
    }

    public function testRemoveWaypointOrders()
    {
        $this->directionsRoute->setWaypointOrders($waypointOrders = array('foo'));
        $this->directionsRoute->removeWaypointOrders($waypointOrders);

        $this->assertNoWaypointOrders();
    }

    public function testResetWaypointOrders()
    {
        $this->directionsRoute->setWaypointOrders(array(1));
        $this->directionsRoute->resetWaypointOrders();

        $this->assertNoWaypointOrders();
    }

    public function testAddWaypointOrder()
    {
        $this->directionsRoute->addWaypointOrder($waypointOrder = 1);

        $this->assertWaypointOrder($waypointOrder);
    }

    public function testAddWaypointOrderUnicity()
    {
        $this->directionsRoute->resetWaypointOrders();
        $this->directionsRoute->addWaypointOrder($waypointOrder = 'foo');
        $this->directionsRoute->addWaypointOrder($waypointOrder);

        $this->assertWaypointOrders(array($waypointOrder));
    }

    public function testRemoveWaypointOrder()
    {
        $this->directionsRoute->addWaypointOrder($waypointOrder = 1);
        $this->directionsRoute->removeWaypointOrder($waypointOrder);

        $this->assertNoWaypointOrder($waypointOrder);
    }

    /**
     * Asserts there are legs.
     *
     * @param array $legs The legs.
     */
    private function assertLegs($legs)
    {
        $this->assertInternalType('array', $legs);

        $this->assertTrue($this->directionsRoute->hasLegs());
        $this->assertSame($legs, $this->directionsRoute->getLegs());

        foreach ($legs as $leg) {
            $this->assertLeg($leg);
        }
    }

    /**
     * Asserts there is a leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg $leg The direction leg.
     */
    private function assertLeg($leg)
    {
        $this->assertDirectionsLegInstance($leg);
        $this->assertTrue($this->directionsRoute->hasLeg($leg));
    }

    /**
     * Asserts there are no legs.
     */
    private function assertNoLegs()
    {
        $this->assertFalse($this->directionsRoute->hasLegs());
        $this->assertEmpty($this->directionsRoute->getLegs());
    }

    /**
     * Asserts there is no leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg $leg The leg.
     */
    private function assertNoLeg($leg)
    {
        $this->assertDirectionsLegInstance($leg);
        $this->assertFalse($this->directionsRoute->hasLeg($leg));
    }

    /**
     * Asserts there are warnings.
     *
     * @param array $warnings The warnings.
     */
    private function assertWarnings($warnings)
    {
        $this->assertInternalType('array', $warnings);

        $this->assertTrue($this->directionsRoute->hasWarnings());
        $this->assertSame($warnings, $this->directionsRoute->getWarnings());

        foreach ($warnings as $warning) {
            $this->assertWarning($warning);
        }
    }

    /**
     * Asserts there is a warning.
     *
     * @param string $warning The warning.
     */
    private function assertWarning($warning)
    {
        $this->assertTrue($this->directionsRoute->hasWarning($warning));
    }

    /**
     * Asserts there are no warnings.
     */
    private function assertNoWarnings()
    {
        $this->assertFalse($this->directionsRoute->hasWarnings());
        $this->assertEmpty($this->directionsRoute->getWarnings());
    }

    /**
     * Asserts there is no warning.
     *
     * @param string $warning The warning.
     */
    private function assertNoWarning($warning)
    {
        $this->assertFalse($this->directionsRoute->hasWarning($warning));
    }

    /**
     * Asserts there are waypoint orders.
     *
     * @param array $waypointOrders The waypoint orders.
     */
    private function assertWaypointOrders($waypointOrders)
    {
        $this->assertInternalType('array', $waypointOrders);

        $this->assertTrue($this->directionsRoute->hasWaypointOrders());
        $this->assertSame($waypointOrders, $this->directionsRoute->getWaypointOrders());

        foreach ($waypointOrders as $waypointOrder) {
            $this->assertWaypointOrder($waypointOrder);
        }
    }

    /**
     * Asserts there is a waypoint order.
     *
     * @param integer $waypointOrder The waypoint order.
     */
    private function assertWaypointOrder($waypointOrder)
    {
        $this->assertTrue($this->directionsRoute->hasWaypointOrder($waypointOrder));
    }

    /**
     * Asserts there are no waypoint orders.
     */
    private function assertNoWaypointOrders()
    {
        $this->assertFalse($this->directionsRoute->hasWaypointOrders());
        $this->assertEmpty($this->directionsRoute->getWaypointOrders());
    }

    /**
     * Asserts there is no waypoint order.
     *
     * @param integer $waypointOrder The waypoint order.
     */
    private function assertNoWaypointOrder($waypointOrder)
    {
        $this->assertFalse($this->directionsRoute->hasWaypointOrder($waypointOrder));
    }
}
