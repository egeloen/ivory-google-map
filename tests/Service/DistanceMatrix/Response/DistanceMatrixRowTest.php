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

use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DistanceMatrixRow
     */
    private $row;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->row = new DistanceMatrixRow();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->row->hasElements());
        $this->assertEmpty($this->row->getElements());
    }

    public function testSetElements()
    {
        $this->row->setElements($elements = [$element = $this->createElementMock()]);
        $this->row->setElements($elements);

        $this->assertTrue($this->row->hasElements());
        $this->assertTrue($this->row->hasElement($element));
        $this->assertSame($elements, $this->row->getElements());
    }

    public function testAddElements()
    {
        $this->row->setElements($firstElements = [$this->createElementMock()]);
        $this->row->addElements($secondElements = [$this->createElementMock()]);

        $this->assertTrue($this->row->hasElements());
        $this->assertSame(array_merge($firstElements, $secondElements), $this->row->getElements());
    }

    public function testAddElement()
    {
        $this->row->addElement($element = $this->createElementMock());

        $this->assertTrue($this->row->hasElements());
        $this->assertTrue($this->row->hasElement($element));
        $this->assertSame([$element], $this->row->getElements());
    }

    public function testRemoveElement()
    {
        $this->row->addElement($element = $this->createElementMock());
        $this->row->removeElement($element);

        $this->assertFalse($this->row->hasElements());
        $this->assertFalse($this->row->hasElement($element));
        $this->assertEmpty($this->row->getElements());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixElement
     */
    private function createElementMock()
    {
        return $this->createMock(DistanceMatrixElement::class);
    }
}
