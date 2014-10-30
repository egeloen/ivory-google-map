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

/**
 * Uninstantiable asset test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class UninstantiableAssetTest extends AbstractTestCase
{
    public function testDisabledConstructor()
    {
        $reflectionMethod = new \ReflectionMethod('Ivory\GoogleMap\Assets\AbstractUninstantiableAsset', '__construct');

        $this->assertTrue($reflectionMethod->isConstructor());
        $this->assertTrue($reflectionMethod->isFinal());
        $this->assertTrue($reflectionMethod->isPrivate());
    }
}
