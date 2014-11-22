<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Polyline;

/**
 * Polyline test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\Polyline */
    private $polyline;

    /** @var array */
    private $coordinates;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polyline = new Polyline($this->coordinates = array($this->createCoordinateMock()));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinates);
        unset($this->polyline);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->polyline);
        $this->assertExtendableInstance($this->polyline);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('polyline_', $this->polyline->getVariable());
        $this->assertCoordinates($this->coordinates);
        $this->assertFalse($this->polyline->hasOptions());
    }

    public function testSetCoordinates()
    {
        $this->polyline->setCoordinates($coordinates = array($this->createCoordinateMock()));

        $this->assertCoordinates($coordinates);
    }

    public function testAddCoordinates()
    {
        $this->polyline->setCoordinates($coordinates = array($this->createCoordinateMock()));
        $this->polyline->addCoordinates($newCoordinates = array($this->createCoordinateMock()));

        $this->assertCoordinates(array_merge($coordinates, $newCoordinates));
    }

    public function testRemoveCoordinates()
    {
        $this->polyline->setCoordinates($coordinates = array($this->createCoordinateMock()));
        $this->polyline->removeCoordinates($coordinates);

        $this->assertNoCoordinates();
    }

    public function testResetCoordinates()
    {
        $this->polyline->setCoordinates(array($this->createCoordinateMock()));
        $this->polyline->resetCoordinates();

        $this->assertNoCoordinates();
    }

    public function testAddCoordinate()
    {
        $this->polyline->addCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertCoordinate($coordinate);
    }

    public function testAddCoordinateUnicity()
    {
        $this->polyline->resetCoordinates();
        $this->polyline->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polyline->addCoordinate($coordinate);

        $this->assertCoordinates(array($coordinate));
    }

    public function testRemoveCoordinate()
    {
        $this->polyline->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polyline->removeCoordinate($coordinate);

        $this->assertNoCoordinate($coordinate);
    }

    public function testRenderExtend()
    {
        $this->polyline->setVariable('polyline');

        $this->assertSame(
            'polyline.getPath().forEach(function(e){bound.extend(e);})',
            $this->polyline->renderExtend($this->createBoundMock())
        );
    }

    /**
     * Asserts there are coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    private function assertCoordinates($coordinates)
    {
        $this->assertInternalType('array', $coordinates);

        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertSame($coordinates, $this->polyline->getCoordinates());

        foreach ($coordinates as $coordinate) {
            $this->assertCoordinate($coordinate);
        }
    }

    /**
     * Asserts there is a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    private function assertCoordinate($coordinate)
    {
        $this->assertCoordinateInstance($coordinate);
        $this->assertTrue($this->polyline->hasCoordinate($coordinate));
    }

    /**
     * Asserts there are no coordinates.
     */
    private function assertNoCoordinates()
    {
        $this->assertFalse($this->polyline->hasCoordinates());
        $this->assertEmpty($this->polyline->getCoordinates());
    }

    /**
     * Asserts there is no coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    private function assertNoCoordinate($coordinate)
    {
        $this->assertCoordinateInstance($coordinate);
        $this->assertFalse($this->polyline->hasCoordinate($coordinate));
    }
}
