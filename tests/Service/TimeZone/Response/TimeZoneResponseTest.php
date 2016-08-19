<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\TimeZone\Response;

use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TimeZoneResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new TimeZoneResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasDstOffset());
        $this->assertNull($this->response->getDstOffset());
        $this->assertFalse($this->response->hasRawOffset());
        $this->assertNull($this->response->getRawOffset());
        $this->assertFalse($this->response->hasTimeZoneId());
        $this->assertNull($this->response->getTimeZoneId());
        $this->assertFalse($this->response->hasTimeZoneName());
        $this->assertNull($this->response->getTimeZoneName());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = TimeZoneStatus::OK);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testDstOffset()
    {
        $this->response->setDstOffset($dstOffset = 123);

        $this->assertTrue($this->response->hasDstOffset());
        $this->assertSame($dstOffset, $this->response->getDstOffset());
    }

    public function testRawOffset()
    {
        $this->response->setRawOffset($rawOffset = 123);

        $this->assertTrue($this->response->hasRawOffset());
        $this->assertSame($rawOffset, $this->response->getRawOffset());
    }

    public function testTimeZoneId()
    {
        $this->response->setTimeZoneId($timeZoneId = 'id');

        $this->assertTrue($this->response->hasTimeZoneId());
        $this->assertSame($timeZoneId, $this->response->getTimeZoneId());
    }

    public function testTimeZoneName()
    {
        $this->response->setTimeZoneName($timeZoneName = 'name');

        $this->assertTrue($this->response->hasTimeZoneName());
        $this->assertSame($timeZoneName, $this->response->getTimeZoneName());
    }
}
