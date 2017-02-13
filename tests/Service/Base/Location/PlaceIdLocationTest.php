<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Service\Base\Location;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceIdLocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceIdLocation
     */
    private $placeIdLocation;

    /**
     * @var string
     */
    private $placeId;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->placeIdLocation = new PlaceIdLocation($this->placeId = 'place');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(LocationInterface::class, $this->placeIdLocation);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->placeId, $this->placeIdLocation->getPlaceId());
    }

    public function testPlaceId()
    {
        $this->placeIdLocation->setPlaceId($placeId = 'foo');

        $this->assertSame($placeId, $this->placeIdLocation->getPlaceId());
    }

    public function testBuildQuery()
    {
        $this->assertSame('place_id:'.$this->placeId, $this->placeIdLocation->buildQuery());
    }
}
