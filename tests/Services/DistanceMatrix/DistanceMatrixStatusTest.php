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

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;

/**
 * Distance matrix status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixStatusTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus');
    }

    public function testConstants()
    {
        $this->assertSame('INVALID_REQUEST', DistanceMatrixStatus::INVALID_REQUEST);
        $this->assertSame('MAX_DIMENSIONS_EXCEEDED', DistanceMatrixStatus::MAX_DIMENSIONS_EXCEEDED);
        $this->assertSame('MAX_ELEMENTS_EXCEEDED', DistanceMatrixStatus::MAX_ELEMENTS_EXCEEDED);
        $this->assertSame('OK', DistanceMatrixStatus::OK);
        $this->assertSame('OVER_QUERY_LIMIT', DistanceMatrixStatus::OVER_QUERY_LIMIT);
        $this->assertSame('REQUEST_DENIED', DistanceMatrixStatus::REQUEST_DENIED);
        $this->assertSame('UNKNOWN_ERROR', DistanceMatrixStatus::UNKNOWN_ERROR);
    }
}
