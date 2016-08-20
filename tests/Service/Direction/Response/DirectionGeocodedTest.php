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

use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocodedStatus;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocodedType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionGeocodedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionGeocoded
     */
    private $geocodedWaypoint;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocodedWaypoint = new DirectionGeocoded();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->geocodedWaypoint->hasStatus());
        $this->assertNull($this->geocodedWaypoint->getStatus());
        $this->assertFalse($this->geocodedWaypoint->hasPartialMatch());
        $this->assertNull($this->geocodedWaypoint->isPartialMatch());
        $this->assertFalse($this->geocodedWaypoint->hasPlaceId());
        $this->assertNull($this->geocodedWaypoint->getPlaceId());
        $this->assertFalse($this->geocodedWaypoint->hasTypes());
        $this->assertEmpty($this->geocodedWaypoint->getTypes());
    }

    public function testStatus()
    {
        $this->geocodedWaypoint->setStatus($status = DirectionGeocodedStatus::OK);

        $this->assertTrue($this->geocodedWaypoint->hasStatus());
        $this->assertSame($status, $this->geocodedWaypoint->getStatus());
    }

    public function testPartialMatch()
    {
        $this->geocodedWaypoint->setPartialMatch(true);

        $this->assertTrue($this->geocodedWaypoint->hasPartialMatch());
        $this->assertTrue($this->geocodedWaypoint->isPartialMatch());
    }

    public function testPlaceId()
    {
        $this->geocodedWaypoint->setPlaceId($placeId = 'id');

        $this->assertTrue($this->geocodedWaypoint->hasPlaceId());
        $this->assertSame($placeId, $this->geocodedWaypoint->getPlaceId());
    }

    public function testSetTypes()
    {
        $this->geocodedWaypoint->setTypes($types = [$type = DirectionGeocodedType::AIRPORT]);
        $this->geocodedWaypoint->setTypes($types);

        $this->assertTrue($this->geocodedWaypoint->hasTypes());
        $this->assertTrue($this->geocodedWaypoint->hasType($type));
        $this->assertSame($types, $this->geocodedWaypoint->getTypes());
    }

    public function testAddTypes()
    {
        $this->geocodedWaypoint->setTypes($firstTypes = [DirectionGeocodedType::AIRPORT]);
        $this->geocodedWaypoint->addTypes($secondTypes = [DirectionGeocodedType::COUNTRY]);

        $this->assertTrue($this->geocodedWaypoint->hasTypes());
        $this->assertSame(array_merge($firstTypes, $secondTypes), $this->geocodedWaypoint->getTypes());
    }

    public function testAddType()
    {
        $this->geocodedWaypoint->addType($type = DirectionGeocodedType::AIRPORT);

        $this->assertTrue($this->geocodedWaypoint->hasTypes());
        $this->assertTrue($this->geocodedWaypoint->hasType($type));
        $this->assertSame([$type], $this->geocodedWaypoint->getTypes());
    }

    public function testRemoveType()
    {
        $this->geocodedWaypoint->addType($type = DirectionGeocodedType::AIRPORT);
        $this->geocodedWaypoint->removeType($type);

        $this->assertFalse($this->geocodedWaypoint->hasTypes());
        $this->assertFalse($this->geocodedWaypoint->hasType($type));
        $this->assertEmpty($this->geocodedWaypoint->getTypes());
    }
}
