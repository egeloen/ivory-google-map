<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix\Response;

use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DistanceMatrixResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new DistanceMatrixResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRequest());
        $this->assertNull($this->response->getRequest());
        $this->assertFalse($this->response->hasOrigins());
        $this->assertEmpty($this->response->getOrigins());
        $this->assertFalse($this->response->hasDestinations());
        $this->assertEmpty($this->response->getDestinations());
        $this->assertFalse($this->response->hasRows());
        $this->assertEmpty($this->response->getRows());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = DistanceMatrixStatus::INVALID_REQUEST);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testRequest()
    {
        $this->response->setRequest($request = $this->createRequestMock());

        $this->assertTrue($this->response->hasRequest());
        $this->assertSame($request, $this->response->getRequest());
    }

    public function testResetStatus()
    {
        $this->response->setStatus(DistanceMatrixStatus::INVALID_REQUEST);
        $this->response->setStatus(null);

        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
    }

    public function testSetOrigins()
    {
        $this->response->setOrigins($origins = [$origin = 'Paris']);
        $this->response->setOrigins($origins);

        $this->assertTrue($this->response->hasOrigins());
        $this->assertTrue($this->response->hasOrigin($origin));
        $this->assertSame($origins, $this->response->getOrigins());
    }

    public function testAddOrigins()
    {
        $this->response->setOrigins($firstOrigins = ['Paris']);
        $this->response->addOrigins($secondOrigins = ['Lille']);

        $this->assertTrue($this->response->hasOrigins());
        $this->assertSame(array_merge($firstOrigins, $secondOrigins), $this->response->getOrigins());
    }

    public function testAddOrigin()
    {
        $this->response->addOrigin($origin = 'Paris');

        $this->assertTrue($this->response->hasOrigins());
        $this->assertTrue($this->response->hasOrigin($origin));
        $this->assertSame([$origin], $this->response->getOrigins());
    }

    public function testRemoveOrigin()
    {
        $this->response->addOrigin($origin = 'Paris');
        $this->response->removeOrigin($origin);

        $this->assertFalse($this->response->hasOrigins());
        $this->assertFalse($this->response->hasOrigin($origin));
        $this->assertEmpty($this->response->getOrigins());
    }

    public function testSetDestinations()
    {
        $this->response->setDestinations($destinations = [$destination = 'Paris']);
        $this->response->setDestinations($destinations);

        $this->assertTrue($this->response->hasDestinations());
        $this->assertTrue($this->response->hasDestination($destination));
        $this->assertSame($destinations, $this->response->getDestinations());
    }

    public function testAddDestinations()
    {
        $this->response->setDestinations($firstDestinations = ['Paris']);
        $this->response->addDestinations($secondDestinations = ['Lille']);

        $this->assertTrue($this->response->hasDestinations());
        $this->assertSame(array_merge($firstDestinations, $secondDestinations), $this->response->getDestinations());
    }

    public function testAddDestination()
    {
        $this->response->addDestination($destination = 'Paris');

        $this->assertTrue($this->response->hasDestinations());
        $this->assertTrue($this->response->hasDestination($destination));
        $this->assertSame([$destination], $this->response->getDestinations());
    }

    public function testRemoveDestination()
    {
        $this->response->addDestination($destination = 'Paris');
        $this->response->removeDestination($destination);

        $this->assertFalse($this->response->hasDestinations());
        $this->assertFalse($this->response->hasDestination($destination));
        $this->assertEmpty($this->response->getDestinations());
    }

    public function testSetRows()
    {
        $this->response->setRows($rows = [$row = $this->createRowMock()]);
        $this->response->setRows($rows);

        $this->assertTrue($this->response->hasRows());
        $this->assertTrue($this->response->hasRow($row));
        $this->assertSame($rows, $this->response->getRows());
    }

    public function testAddRows()
    {
        $this->response->setRows($firstRows = [$this->createRowMock()]);
        $this->response->addRows($secondRows = [$this->createRowMock()]);

        $this->assertTrue($this->response->hasRows());
        $this->assertSame(array_merge($firstRows, $secondRows), $this->response->getRows());
    }

    public function testAddRow()
    {
        $this->response->addRow($row = $this->createRowMock());

        $this->assertTrue($this->response->hasRows());
        $this->assertTrue($this->response->hasRow($row));
        $this->assertSame([$row], $this->response->getRows());
    }

    public function testRemoveRow()
    {
        $this->response->addRow($row = $this->createRowMock());
        $this->response->removeRow($row);

        $this->assertFalse($this->response->hasRows());
        $this->assertFalse($this->response->hasRow($row));
        $this->assertEmpty($this->response->getRows());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(DistanceMatrixRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixRow
     */
    private function createRowMock()
    {
        return $this->createMock(DistanceMatrixRow::class);
    }
}
