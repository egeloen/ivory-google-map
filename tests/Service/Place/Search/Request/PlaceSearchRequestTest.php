<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\ContextualizedRequestInterface;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;
use Ivory\GoogleMap\Service\Place\Search\Request\AbstractPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractPlaceSearchRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->createRequestMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(PlaceSearchRequestInterface::class, $this->request);
        $this->assertInstanceOf(ContextualizedRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->request->hasLocation());
        $this->assertNull($this->request->getLocation());
        $this->assertFalse($this->request->hasRadius());
        $this->assertNull($this->request->getRadius());
        $this->assertFalse($this->request->hasMinPrice());
        $this->assertNull($this->request->getMinPrice());
        $this->assertFalse($this->request->hasMaxPrice());
        $this->assertNull($this->request->getMaxPrice());
        $this->assertFalse($this->request->hasOpenNow());
        $this->assertNull($this->request->isOpenNow());
        $this->assertFalse($this->request->hasType());
        $this->assertNull($this->request->getType());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testLocation()
    {
        $this->request->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->request->hasLocation());
        $this->assertSame($location, $this->request->getLocation());
    }

    public function testRadius()
    {
        $this->request->setRadius($radius = 1234);

        $this->assertTrue($this->request->hasRadius());
        $this->assertSame($radius, $this->request->getRadius());
    }

    public function testMinPrice()
    {
        $this->request->setMinPrice($minPrice = PriceLevel::FREE);

        $this->assertTrue($this->request->hasMinPrice());
        $this->assertSame($minPrice, $this->request->getMinPrice());
    }

    public function testMaxPrice()
    {
        $this->request->setMaxPrice($maxPrice = PriceLevel::FREE);

        $this->assertTrue($this->request->hasMaxPrice());
        $this->assertSame($maxPrice, $this->request->getMaxPrice());
    }

    public function testOpenNow()
    {
        $this->request->setOpenNow(true);

        $this->assertTrue($this->request->hasOpenNow());
        $this->assertTrue($this->request->isOpenNow());
    }

    public function testType()
    {
        $this->request->setType($type = PlaceType::AIRPORT);

        $this->assertTrue($this->request->hasType());
        $this->assertSame($type, $this->request->getType());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testBuildQuery()
    {
        $this->assertEmpty($this->request->buildQuery());
    }

    public function testBuildQueryWithLocation()
    {
        $location = $this->createCoordinateMock();
        $location
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue(1.23));

        $location
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue(2.13));

        $this->request->setLocation($location);

        $this->assertSame(['location' => '1.23,2.13'], $this->request->buildQuery());
    }

    public function testBuildQueryWithRadius()
    {
        $this->request->setRadius($radius = 1234);

        $this->assertSame(['radius' => $radius], $this->request->buildQuery());
    }

    public function testBuildQueryWithMinPrice()
    {
        $this->request->setMinPrice($minPrice = PriceLevel::INEXPENSIVE);

        $this->assertSame(['minprice' => $minPrice], $this->request->buildQuery());
    }

    public function testBuildQueryWithMaxPrice()
    {
        $this->request->setMaxPrice($maxPrice = PriceLevel::VERY_EXPENSIVE);

        $this->assertSame(['maxprice' => $maxPrice], $this->request->buildQuery());
    }

    public function testBuildQueryWithType()
    {
        $this->request->setType($type = PlaceType::AIRPORT);

        $this->assertSame(['type' => $type], $this->request->buildQuery());
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame(['language' => $language], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractPlaceSearchRequest
     */
    private function createRequestMock()
    {
        return $this->getMockForAbstractClass(AbstractPlaceSearchRequest::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
