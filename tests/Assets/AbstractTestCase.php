<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Assets;

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Assets test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Creates an options assets mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The options asset mock builder.
     */
    protected function createOptionsAssetMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Assets\AbstractOptionsAsset');
    }
}
