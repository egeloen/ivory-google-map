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

/**
 * Abstract extendable test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractExtendableTest extends AbstractTestCase
{
    abstract public function testRenderExtend();

    /**
     * Creates a bound mock.
     *
     * @param string|null $variable The variable.
     *
     * @return \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject The bound.
     */
    protected function createBoundMock($variable = 'bound')
    {
        $bound = parent::createBoundMock();
        $bound
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue($variable));

        return $bound;
    }
}
