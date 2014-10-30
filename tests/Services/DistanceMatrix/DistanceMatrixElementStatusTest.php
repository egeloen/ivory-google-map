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

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;

/**
 * Distance matrix element status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixElementStatusTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus');
    }

    public function testConstants()
    {
        $this->assertSame('NOT_FOUND', DistanceMatrixElementStatus::NOT_FOUND);
        $this->assertSame('OK', DistanceMatrixElementStatus::OK);
        $this->assertSame('ZERO_RESULTS', DistanceMatrixElementStatus::ZERO_RESULTS);
    }
}
