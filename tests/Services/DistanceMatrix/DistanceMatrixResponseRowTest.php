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

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow;

/**
 * Directions response row test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseRowTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    private $distanceMatrixResponseRow;

    /** @var array */
    private $elements;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixResponseRow = new DistanceMatrixResponseRow(
            $this->elements = array($this->createDistanceMatrixResponseElementMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->elements);
        unset($this->distanceMatrixResponseRow);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->elements, $this->distanceMatrixResponseRow->getElements());
    }

    public function testSetElements()
    {
        $this->distanceMatrixResponseRow->setElements($elements = array($this->createDistanceMatrixResponseElementMock()));

        $this->assertElements($elements);
    }

    public function testAddElements()
    {
        $this->distanceMatrixResponseRow->setElements($elements = array($this->createDistanceMatrixResponseElementMock()));
        $this->distanceMatrixResponseRow->addElements($newElements = array($this->createDistanceMatrixResponseElementMock()));

        $this->assertElements(array_merge($elements, $newElements));
    }

    public function testRemoveElements()
    {
        $this->distanceMatrixResponseRow->setElements($elements = array($this->createDistanceMatrixResponseElementMock()));
        $this->distanceMatrixResponseRow->removeElements($elements);

        $this->assertNoElements();
    }

    public function testResetElements()
    {
        $this->distanceMatrixResponseRow->setElements(array($this->createDistanceMatrixResponseElementMock()));
        $this->distanceMatrixResponseRow->resetElements();

        $this->assertNoElements();
    }

    public function testAddElement()
    {
        $this->distanceMatrixResponseRow->addElement($element = $this->createDistanceMatrixResponseElementMock());

        $this->assertElement($element);
    }

    public function testAddElementUnicity()
    {
        $this->distanceMatrixResponseRow->resetElements();
        $this->distanceMatrixResponseRow->addElement($element = $this->createDistanceMatrixResponseElementMock());
        $this->distanceMatrixResponseRow->addElement($element);

        $this->assertElements(array($element));
    }

    public function testRemoveElement()
    {
        $this->distanceMatrixResponseRow->addElement($element = $this->createDistanceMatrixResponseElementMock());
        $this->distanceMatrixResponseRow->removeElement($element);

        $this->assertNoElement($element);
    }

    /**
     * Asserts there are elements.
     *
     * @param array $elements The elements.
     */
    private function assertElements($elements)
    {
        $this->assertInternalType('array', $elements);

        $this->assertTrue($this->distanceMatrixResponseRow->hasElements());
        $this->assertSame($elements, $this->distanceMatrixResponseRow->getElements());

        foreach ($elements as $element) {
            $this->assertElement($element);
        }
    }

    /**
     * Asserts there is an element;
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element.
     */
    private function assertElement($element)
    {
        $this->assertDistanceMatrixResponseElementInstance($element);
        $this->assertTrue($this->distanceMatrixResponseRow->hasElement($element));
    }

    /**
     * Asserts there are no elements.
     */
    private function assertNoElements()
    {
        $this->assertFalse($this->distanceMatrixResponseRow->hasElements());
        $this->assertEmpty($this->distanceMatrixResponseRow->getElements());
    }

    /**
     * Asserts there is no element.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element.
     */
    private function assertNoElement($element)
    {
        $this->assertDistanceMatrixResponseElementInstance($element);
        $this->assertFalse($this->distanceMatrixResponseRow->hasElement($element));
    }
}
