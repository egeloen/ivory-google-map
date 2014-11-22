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

use Ivory\Tests\GoogleMap\Services\AbstractTestCase as TestCase;

/**
 * Distance matrix test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a distance matrix response element intance.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The distance matrix response element.
     */
    protected function assertDistanceMatrixResponseElementInstance($element)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement', $element);
    }

    /**
     * Asserts a distance matrix response row intance.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The distance matrix response row.
     */
    protected function assertDistanceMatrixResponseRowInstance($row)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow', $row);
    }

    /**
     * Creates a distance matrix response element mock.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement|\PHPUnit_Framework_MockObject_MockObject The distance matrix response element mock.
     */
    protected function createDistanceMatrixResponseElementMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a distance matrix response row mock.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow|\PHPUnit_Framework_MockObject_MockObject The distance matrix response row mock.
     */
    protected function createDistanceMatrixResponseRowMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
