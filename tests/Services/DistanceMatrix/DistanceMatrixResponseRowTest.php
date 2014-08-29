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
class DirectionsResponseRowTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    protected $distanceMatrixResponseRow;

    /** @var array */
    protected $elements;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $element = $this->getMockBuilder('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement')
            ->disableOriginalConstructor()
            ->getMock();

        $this->elements = array($element);

        $this->distanceMatrixResponseRow = new DistanceMatrixResponseRow($this->elements);
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
}
