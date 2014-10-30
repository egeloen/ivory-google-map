<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;

/**
 * Directions response test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    private $distanceMatrixResponse;

    /** @var string */
    private $status;

    /** @var array */
    private $origins;

    /** @var array */
    private $destinations;

    /** @var array */
    private $rows;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixResponse = new DistanceMatrixResponse(
            $this->status = DistanceMatrixStatus::REQUEST_DENIED,
            $this->origins = array('origin'),
            $this->destinations = array('destination'),
            $this->rows = array($this->createDistanceMatrixResponseRowMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->status);
        unset($this->origins);
        unset($this->destinations);
        unset($this->rows);
        unset($this->distanceMatrixResponse);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->status, $this->distanceMatrixResponse->getStatus());
        $this->assertSame($this->origins, $this->distanceMatrixResponse->getOrigins());
        $this->assertSame($this->destinations, $this->distanceMatrixResponse->getDestinations());
        $this->assertSame($this->rows, $this->distanceMatrixResponse->getRows());
    }

    public function testSetStatus()
    {
        $this->distanceMatrixResponse->setStatus($status = DistanceMatrixStatus::OK);

        $this->assertSame($status, $this->distanceMatrixResponse->getStatus());
    }

    public function testSetOrigins()
    {
        $this->distanceMatrixResponse->setOrigins($origins = array('foo'));

        $this->assertOrigins($origins);
    }

    public function testAddOrigins()
    {
        $this->distanceMatrixResponse->setOrigins($origins = array('foo'));
        $this->distanceMatrixResponse->addOrigins($newOrigins = array('bar'));

        $this->assertOrigins(array_merge($origins, $newOrigins));
    }

    public function testRemoveOrigins()
    {
        $this->distanceMatrixResponse->setOrigins($origins = array('foo'));
        $this->distanceMatrixResponse->removeOrigins($origins);

        $this->assertNoOrigins();
    }

    public function testResetOrigins()
    {
        $this->distanceMatrixResponse->setOrigins(array('foo'));
        $this->distanceMatrixResponse->resetOrigins();

        $this->assertNoOrigins();
    }

    public function testAddOrigin()
    {
        $this->distanceMatrixResponse->addOrigin($origin = 'foo');

        $this->assertOrigin($origin);
    }

    public function testAddOriginUnicity()
    {
        $this->distanceMatrixResponse->resetOrigins();
        $this->distanceMatrixResponse->addOrigin($origin = 'foo');
        $this->distanceMatrixResponse->addOrigin($origin);

        $this->assertOrigins(array($origin));
    }

    public function testRemoveOrigin()
    {
        $this->distanceMatrixResponse->addOrigin($origin = 'foo');
        $this->distanceMatrixResponse->removeOrigin($origin);

        $this->assertNoOrigin($origin);
    }

    public function testSetDestinations()
    {
        $this->distanceMatrixResponse->setDestinations($destinations = array('foo'));

        $this->assertDestinations($destinations);
    }

    public function testAddDestinations()
    {
        $this->distanceMatrixResponse->setDestinations($destinations = array('foo'));
        $this->distanceMatrixResponse->addDestinations($newDestinations = array('bar'));

        $this->assertDestinations(array_merge($destinations, $newDestinations));
    }

    public function testRemoveDestinations()
    {
        $this->distanceMatrixResponse->setDestinations($destinations = array('foo'));
        $this->distanceMatrixResponse->removeDestinations($destinations);

        $this->assertNoDestinations();
    }

    public function testResetDestinations()
    {
        $this->distanceMatrixResponse->setDestinations(array('foo'));
        $this->distanceMatrixResponse->resetDestinations();

        $this->assertNoDestinations();
    }

    public function testAddDestination()
    {
        $this->distanceMatrixResponse->addDestination($destination = 'foo');

        $this->assertDestination($destination);
    }

    public function testAddDestinationUnicity()
    {
        $this->distanceMatrixResponse->resetDestinations();
        $this->distanceMatrixResponse->addDestination($destination = 'foo');
        $this->distanceMatrixResponse->addDestination($destination);

        $this->assertDestinations(array($destination));
    }

    public function testRemoveDestination()
    {
        $this->distanceMatrixResponse->addDestination($destination = 'foo');
        $this->distanceMatrixResponse->removeDestination($destination);

        $this->assertNoDestination($destination);
    }

    public function testSetRows()
    {
        $this->distanceMatrixResponse->setRows($rows = array($this->createDistanceMatrixResponseRowMock()));

        $this->assertRows($rows);
    }

    public function testAddRows()
    {
        $this->distanceMatrixResponse->setRows($rows = array($this->createDistanceMatrixResponseRowMock()));
        $this->distanceMatrixResponse->addRows($newRows = array($this->createDistanceMatrixResponseRowMock()));

        $this->assertRows(array_merge($rows, $newRows));
    }

    public function testRemoveRows()
    {
        $this->distanceMatrixResponse->setRows($rows = array($this->createDistanceMatrixResponseRowMock()));
        $this->distanceMatrixResponse->removeRows($rows);

        $this->assertNoRows();
    }

    public function testResetRows()
    {
        $this->distanceMatrixResponse->setRows(array($this->createDistanceMatrixResponseRowMock()));
        $this->distanceMatrixResponse->resetRows();

        $this->assertNoRows();
    }

    public function testAddRow()
    {
        $this->distanceMatrixResponse->addRow($row = $this->createDistanceMatrixResponseRowMock());

        $this->assertRow($row);
    }

    public function testAddRowUnicity()
    {
        $this->distanceMatrixResponse->resetRows();
        $this->distanceMatrixResponse->addRow($row = $this->createDistanceMatrixResponseRowMock());
        $this->distanceMatrixResponse->addRow($row);

        $this->assertRows(array($row));
    }

    public function testRemoveRow()
    {
        $this->distanceMatrixResponse->addRow($row = $this->createDistanceMatrixResponseRowMock());
        $this->distanceMatrixResponse->removeRow($row);

        $this->assertNoRow($row);
    }

    /**
     * Asserts there are origins.
     *
     * @param array $origins The origins.
     */
    private function assertOrigins($origins)
    {
        $this->assertInternalType('array', $origins);

        $this->assertTrue($this->distanceMatrixResponse->hasOrigins());
        $this->assertSame($origins, $this->distanceMatrixResponse->getOrigins());

        foreach ($origins as $origin) {
            $this->assertOrigin($origin);
        }
    }

    /**
     * Asserts there is a origin.
     *
     * @param string $origin The origin.
     */
    private function assertOrigin($origin)
    {
        $this->assertTrue($this->distanceMatrixResponse->hasOrigin($origin));
    }

    /**
     * Asserts there are no origins.
     */
    private function assertNoOrigins()
    {
        $this->assertFalse($this->distanceMatrixResponse->hasOrigins());
        $this->assertEmpty($this->distanceMatrixResponse->getOrigins());
    }

    /**
     * Asserts there is no origin.
     *
     * @param string $origin The origin.
     */
    private function assertNoOrigin($origin)
    {
        $this->assertFalse($this->distanceMatrixResponse->hasOrigin($origin));
    }

    /**
     * Asserts there are destinations.
     *
     * @param array $destinations The destinations.
     */
    private function assertDestinations($destinations)
    {
        $this->assertInternalType('array', $destinations);

        $this->assertTrue($this->distanceMatrixResponse->hasDestinations());
        $this->assertSame($destinations, $this->distanceMatrixResponse->getDestinations());

        foreach ($destinations as $destination) {
            $this->assertDestination($destination);
        }
    }

    /**
     * Asserts there is a destination.
     *
     * @param string $destination The destination.
     */
    private function assertDestination($destination)
    {
        $this->assertTrue($this->distanceMatrixResponse->hasDestination($destination));
    }

    /**
     * Asserts there are no destinations.
     */
    private function assertNoDestinations()
    {
        $this->assertFalse($this->distanceMatrixResponse->hasDestinations());
        $this->assertEmpty($this->distanceMatrixResponse->getDestinations());
    }

    /**
     * Asserts there is no destination.
     *
     * @param string $destination The destination.
     */
    private function assertNoDestination($destination)
    {
        $this->assertFalse($this->distanceMatrixResponse->hasDestination($destination));
    }

    /**
     * Asserts there are rows.
     *
     * @param array $rows The rows.
     */
    private function assertRows($rows)
    {
        $this->assertInternalType('array', $rows);

        $this->assertTrue($this->distanceMatrixResponse->hasRows());
        $this->assertSame($rows, $this->distanceMatrixResponse->getRows());

        foreach ($rows as $row) {
            $this->assertRow($row);
        }
    }

    /**
     * Asserts there is a row.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The row.
     */
    private function assertRow($row)
    {
        $this->assertDistanceMatrixResponseRowInstance($row);
        $this->assertTrue($this->distanceMatrixResponse->hasRow($row));
    }

    /**
     * Asserts there are no rows.
     */
    private function assertNoRows()
    {
        $this->assertFalse($this->distanceMatrixResponse->hasRows());
        $this->assertEmpty($this->distanceMatrixResponse->getRows());
    }

    /**
     * Asserts there is no row.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The row.
     */
    private function assertNoRow($row)
    {
        $this->assertDistanceMatrixResponseRowInstance($row);
        $this->assertFalse($this->distanceMatrixResponse->hasRow($row));
    }
}
