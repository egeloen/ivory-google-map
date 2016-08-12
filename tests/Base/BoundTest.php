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
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Bound
     */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = new Bound();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->bound);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('bound', $this->bound->getVariable());
        $this->assertFalse($this->bound->hasSouthWest());
        $this->assertNull($this->bound->getSouthWest());
        $this->assertFalse($this->bound->hasNorthEast());
        $this->assertNull($this->bound->getNorthEast());
        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtendables());
    }

    public function testInitialState()
    {
        $this->bound = new Bound(
            $southWest = $this->createCoordinateMock(),
            $northEast = $this->createCoordinateMock()
        );

        $this->assertStringStartsWith('bound', $this->bound->getVariable());
        $this->assertTrue($this->bound->hasSouthWest());
        $this->assertSame($southWest, $this->bound->getSouthWest());
        $this->assertTrue($this->bound->hasNorthEast());
        $this->assertSame($northEast, $this->bound->getNorthEast());
        $this->assertTrue($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtendables());
    }

    public function testSouthWest()
    {
        $this->bound->setSouthWest($southWest = $this->createCoordinateMock());

        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtendables());
        $this->assertTrue($this->bound->hasSouthWest());
        $this->assertSame($southWest, $this->bound->getSouthWest());
    }

    public function testResetSouthWest()
    {
        $this->bound->setSouthWest($this->createCoordinateMock());
        $this->bound->setSouthWest(null);

        $this->assertFalse($this->bound->hasSouthWest());
        $this->assertNull($this->bound->getSouthWest());
    }

    public function testNorthEast()
    {
        $this->bound->setNorthEast($northEast = $this->createCoordinateMock());

        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtendables());
        $this->assertTrue($this->bound->hasNorthEast());
        $this->assertSame($northEast, $this->bound->getNorthEast());
    }

    public function testResetNorthEast()
    {
        $this->bound->setNorthEast($northEast = $this->createCoordinateMock());
        $this->bound->setNorthEast(null);

        $this->assertFalse($this->bound->hasNorthEast());
        $this->assertNull($this->bound->getNorthEast());
    }

    public function testCoordinates()
    {
        $this->bound->setSouthWest($this->createCoordinateMock());
        $this->bound->setNorthEast($this->createCoordinateMock());

        $this->assertTrue($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtendables());
    }

    public function testSetExtendables()
    {
        $this->bound->setExtendables($extendables = [$extendable = $this->createExtendableMock()]);
        $this->bound->setExtendables($extendables);

        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertTrue($this->bound->hasExtendables());
        $this->assertTrue($this->bound->hasExtendable($extendable));
        $this->assertSame($extendables, $this->bound->getExtendables());
    }

    public function testAddExtendables()
    {
        $this->bound->setExtendables($firstExtendables = [$this->createExtendableMock()]);
        $this->bound->addExtendables($secondExtendables = [$this->createExtendableMock()]);

        $this->assertTrue($this->bound->hasExtendables());
        $this->assertSame(array_merge($firstExtendables, $secondExtendables), $this->bound->getExtendables());
    }

    public function testAddExtendable()
    {
        $this->bound->addExtendable($extendable = $this->createExtendableMock());

        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertTrue($this->bound->hasExtendables());
        $this->assertTrue($this->bound->hasExtendable($extendable));
        $this->assertSame([$extendable], $this->bound->getExtendables());
    }

    public function testRemoveExtendable()
    {
        $this->bound->addExtendable($extendable = $this->createExtendableMock());
        $this->bound->removeExtendable($extendable);

        $this->assertFalse($this->bound->hasExtendables());
        $this->assertFalse($this->bound->hasExtendable($extendable));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ExtendableInterface
     */
    private function createExtendableMock()
    {
        return $this->createMock(ExtendableInterface::class);
    }
}
