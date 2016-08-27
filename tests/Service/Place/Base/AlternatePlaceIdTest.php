<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\PlaceScope;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AlternatePlaceIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AlternatePlaceId
     */
    private $alternatePlaceId;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->alternatePlaceId = new AlternatePlaceId();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->alternatePlaceId->hasPlaceId());
        $this->assertNull($this->alternatePlaceId->getPlaceId());
        $this->assertFalse($this->alternatePlaceId->hasScope());
        $this->assertNull($this->alternatePlaceId->getScope());
    }

    public function testPlaceId()
    {
        $this->alternatePlaceId->setPlaceId($placeId = 'foo');

        $this->assertTrue($this->alternatePlaceId->hasPlaceId());
        $this->assertSame($placeId, $this->alternatePlaceId->getPlaceId());
    }

    public function testScope()
    {
        $this->alternatePlaceId->setScope($scope = PlaceScope::GOOGLE);

        $this->assertTrue($this->alternatePlaceId->hasScope());
        $this->assertSame($scope, $this->alternatePlaceId->getScope());
    }
}
