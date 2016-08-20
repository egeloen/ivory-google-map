<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Fare;
use Ivory\GoogleMap\Service\Direction\Response\DirectionLeg;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionRouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionRoute
     */
    private $route;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->route = new DirectionRoute();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->route->hasBound());
        $this->assertNull($this->route->getBound());
        $this->assertFalse($this->route->hasCopyrights());
        $this->assertNull($this->route->getCopyrights());
        $this->assertFalse($this->route->hasLegs());
        $this->assertEmpty($this->route->getLegs());
        $this->assertFalse($this->route->hasOverviewPolyline());
        $this->assertNull($this->route->getOverviewPolyline());
        $this->assertFalse($this->route->hasSummary());
        $this->assertNull($this->route->getSummary());
        $this->assertFalse($this->route->hasFare());
        $this->assertNull($this->route->getFare());
        $this->assertFalse($this->route->hasWarnings());
        $this->assertEmpty($this->route->getWarnings());
        $this->assertFalse($this->route->hasWaypointOrders());
        $this->assertEmpty($this->route->getWaypointOrders());
    }

    public function testBound()
    {
        $this->route->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->route->hasBound());
        $this->assertSame($bound, $this->route->getBound());
    }

    public function testResetBound()
    {
        $this->route->setBound($this->createBoundMock());
        $this->route->setBound(null);

        $this->assertFalse($this->route->hasBound());
        $this->assertNull($this->route->getBound());
    }

    public function testCopyrights()
    {
        $this->route->setCopyrights($copyrights = 'copyrights');

        $this->assertTrue($this->route->hasCopyrights());
        $this->assertSame($copyrights, $this->route->getCopyrights());
    }

    public function testResetCopyrights()
    {
        $this->route->setCopyrights('copyrights');
        $this->route->setCopyrights(null);

        $this->assertFalse($this->route->hasCopyrights());
        $this->assertNull($this->route->getCopyrights());
    }

    public function testSetLegs()
    {
        $this->route->setLegs($legs = [$leg = $this->createLegMock()]);
        $this->route->setLegs($legs);

        $this->assertTrue($this->route->hasLegs());
        $this->assertTrue($this->route->hasLeg($leg));
        $this->assertSame($legs, $this->route->getLegs());
    }

    public function testAddLegs()
    {
        $this->route->setLegs($firstLegs = [$this->createLegMock()]);
        $this->route->addLegs($secondLegs = [$this->createLegMock()]);

        $this->assertTrue($this->route->hasLegs());
        $this->assertSame(array_merge($firstLegs, $secondLegs), $this->route->getLegs());
    }

    public function testAddLeg()
    {
        $this->route->addLeg($leg = $this->createLegMock());

        $this->assertTrue($this->route->hasLegs());
        $this->assertTrue($this->route->hasLeg($leg));
        $this->assertSame([$leg], $this->route->getLegs());
    }

    public function testRemoveLeg()
    {
        $this->route->addLeg($leg = $this->createLegMock());
        $this->route->removeLeg($leg);

        $this->assertFalse($this->route->hasLegs());
        $this->assertFalse($this->route->hasLeg($leg));
        $this->assertEmpty($this->route->getLegs());
    }

    public function testOverviewPolyline()
    {
        $this->route->setOverviewPolyline($overviewPolyline = $this->createEncodedPolylineMock());

        $this->assertTrue($this->route->hasOverviewPolyline());
        $this->assertSame($overviewPolyline, $this->route->getOverviewPolyline());
    }

    public function testResetOverviewPolyline()
    {
        $this->route->setOverviewPolyline($this->createEncodedPolylineMock());
        $this->route->setOverviewPolyline(null);

        $this->assertFalse($this->route->hasOverviewPolyline());
        $this->assertNull($this->route->getOverviewPolyline());
    }

    public function testSummary()
    {
        $this->route->setSummary($summary = 'summary');

        $this->assertTrue($this->route->hasSummary());
        $this->assertSame($summary, $this->route->getSummary());
    }

    public function testResetSummary()
    {
        $this->route->setSummary('summary');
        $this->route->setSummary(null);

        $this->assertFalse($this->route->hasSummary());
        $this->assertNull($this->route->getSummary());
    }

    public function testFare()
    {
        $this->route->setFare($fare = $this->createFareMock());

        $this->assertTrue($this->route->hasFare());
        $this->assertSame($fare, $this->route->getFare());
    }

    public function testResetFare()
    {
        $this->route->setFare($this->createFareMock());
        $this->route->setFare(null);

        $this->assertFalse($this->route->hasFare());
        $this->assertNull($this->route->getFare());
    }

    public function testSetWarnings()
    {
        $this->route->setWarnings($warnings = [$warning = 'warning']);
        $this->route->setWarnings($warnings);

        $this->assertTrue($this->route->hasWarnings());
        $this->assertTrue($this->route->hasWarning($warning));
        $this->assertSame($warnings, $this->route->getWarnings());
    }

    public function testAddWarnings()
    {
        $this->route->setWarnings($firstWarnings = ['first_warning']);
        $this->route->addWarnings($secondWarnings = ['second_warning']);

        $this->assertTrue($this->route->hasWarnings());
        $this->assertSame(array_merge($firstWarnings, $secondWarnings), $this->route->getWarnings());
    }

    public function testAddWarning()
    {
        $this->route->addWarning($warning = 'warning');

        $this->assertTrue($this->route->hasWarnings());
        $this->assertTrue($this->route->hasWarning($warning));
        $this->assertSame([$warning], $this->route->getWarnings());
    }

    public function testRemoveWarning()
    {
        $this->route->addWarning($warning = 'warning');
        $this->route->removeWarning($warning);

        $this->assertFalse($this->route->hasWarnings());
        $this->assertFalse($this->route->hasWarning($warning));
        $this->assertEmpty($this->route->getWarnings());
    }

    public function testSetWaypointOrders()
    {
        $this->route->setWaypointOrders($waypointOrders = [$waypointOrder = 2, 1]);
        $this->route->setWaypointOrders($waypointOrders);

        $this->assertTrue($this->route->hasWaypointOrders());
        $this->assertTrue($this->route->hasWaypointOrder($waypointOrder));
        $this->assertSame($waypointOrders, $this->route->getWaypointOrders());
    }

    public function testAddWaypointOrder()
    {
        $this->route->addWaypointOrder($waypointOrder = 2);

        $this->assertTrue($this->route->hasWaypointOrders());
        $this->assertTrue($this->route->hasWaypointOrder($waypointOrder));
        $this->assertSame([$waypointOrder], $this->route->getWaypointOrders());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionLeg
     */
    private function createLegMock()
    {
        return $this->createMock(DirectionLeg::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Fare
     */
    private function createFareMock()
    {
        return $this->createMock(Fare::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EncodedPolyline
     */
    private function createEncodedPolylineMock()
    {
        return $this->createMock(EncodedPolyline::class);
    }
}
