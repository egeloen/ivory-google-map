<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder\Request;

use Ivory\GoogleMap\Service\Geocoder\Request\AbstractGeocoderReverseRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderPlaceIdRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderPlaceIdRequest
     */
    private $request;

    /**
     * @var
     */
    private $placeId;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new GeocoderPlaceIdRequest($this->placeId = 'ChIJLU7jZClu5kcR4PcOOO6p3I0');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractGeocoderReverseRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->placeId, $this->request->getPlaceId());
    }

    public function testPlaceId()
    {
        $this->request->setPlaceId($placeId = 'ChIJC_jkvdJv5kcRNX4NW3iuID8');

        $this->assertSame($placeId, $this->request->getPlaceId());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['place_id' => $this->placeId], $this->request->buildQuery());
    }
}
