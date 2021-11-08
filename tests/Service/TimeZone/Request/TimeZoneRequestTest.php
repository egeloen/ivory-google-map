<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\TimeZone\Request;

use PHPUnit\Framework\MockObject\MockObject;
use DateTime;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\RequestInterface;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequest;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneRequestTest extends TestCase
{
    private TimeZoneRequest $request;

    /**
     * @var Coordinate|MockObject
     */
    private $location;

    private ?DateTime $date = null;

    protected function setUp(): void
    {
        $this->request = new TimeZoneRequest(
            $this->location = $this->createCoordinateMock(),
            $this->date = new DateTime()
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(TimeZoneRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->location, $this->request->getLocation());
        $this->assertSame($this->date, $this->request->getDate());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testLocation()
    {
        $this->request->setLocation($location = $this->createCoordinateMock());

        $this->assertSame($location, $this->request->getLocation());
    }

    public function testDate()
    {
        $this->request->setDate($date = new DateTime());

        $this->assertSame($date, $this->request->getDate());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testBuildQuery()
    {
        $this->assertSame([
            'location'  => $this->location->getLatitude().','.$this->location->getLongitude(),
            'timestamp' => $this->date->getTimestamp(),
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'location'  => $this->location->getLatitude().','.$this->location->getLongitude(),
            'timestamp' => $this->date->getTimestamp(),
            'language'  => $language,
        ], $this->request->buildQuery());
    }

    /**
     * @return MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        $coordinate = $this->createMock(Coordinate::class);
        $coordinate
            ->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue(1.2));

        $coordinate
            ->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue(2.3));

        return $coordinate;
    }
}
