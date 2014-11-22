<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Bound test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = new Bound();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->bound);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->bound);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('bound_', $this->bound->getVariable());
        $this->assertNoCoordinates();
    }

    public function testInitialState()
    {
        $this->bound = new Bound(
            $southWest = $this->createCoordinateMock(),
            $northEast = $this->createCoordinateMock()
        );

        $this->assertCoordinates($southWest, $northEast);
    }

    public function testSetSouthWest()
    {
        $this->bound->setSouthWest($southWest = $this->createCoordinateMock());

        $this->assertSouthWest($southWest);
    }

    public function testResetSouthWest()
    {
        $this->bound->setSouthWest($this->createCoordinateMock());
        $this->bound->setSouthWest(null);

        $this->assertNoSouthWest();
    }

    public function testSetNorthEast()
    {
        $this->bound->setNorthEast($northEast = $this->createCoordinateMock());

        $this->assertNorthEast($northEast);
    }

    public function testResetNorthEast()
    {
        $this->bound->setNorthEast($this->createCoordinateMock());
        $this->bound->setNorthEast(null);

        $this->assertNoNorthEast();
    }

    /**
     * Asserts there are coordinates.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $southWest The south west coordinate.
     * @param \Ivory\GoogleMap\Base\Coordinate $northEast The north east coordinate.
     */
    private function assertCoordinates($southWest, $northEast)
    {
        $this->assertTrue($this->bound->hasCoordinates());
        $this->assertSouthWest($southWest);
        $this->assertNorthEast($northEast);
    }

    /**
     * Asserts there is a south west coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $southWest The south west coordinate.
     */
    private function assertSouthWest($southWest)
    {
        $this->assertCoordinateInstance($southWest);

        $this->assertTrue($this->bound->hasSouthWest());
        $this->assertSame($southWest, $this->bound->getSouthWest());
    }

    /**
     * Asserts there is a north east coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $northEast The north east coordinate.
     */
    private function assertNorthEast($northEast)
    {
        $this->assertCoordinateInstance($northEast);

        $this->assertTrue($this->bound->hasNorthEast());
        $this->assertSame($northEast, $this->bound->getNorthEast());
    }

    /**
     * Asserts there are no coordinates.
     */
    private function assertNoCoordinates()
    {
        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertNoSouthWest();
        $this->assertNoNorthEast();
    }

    /**
     * Asserts there is no south west coordinate.
     */
    private function assertNoSouthWest()
    {
        $this->assertFalse($this->bound->hasSouthWest());
        $this->assertNull($this->bound->getSouthWest());
    }

    /**
     * Asserts there is no north east coordinate.
     */
    private function assertNoNorthEast()
    {
        $this->assertFalse($this->bound->hasNorthEast());
        $this->assertNull($this->bound->getNorthEast());
    }
}
