<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\ApiEvents;

/**
 * Api events test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEventsTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Helpers\ApiEvents');
    }

    public function testConstants()
    {
        $this->assertSame('ivory.google_map.api.javascript', ApiEvents::JAVASCRIPT);
        $this->assertSame('ivory.google_map.api.javascript.map', ApiEvents::JAVASCRIPT_MAP);

        $this->assertSame(
            'ivory.google_map.api.javascript.map.encoded_polyline',
            ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE
        );

        $this->assertSame(
            'ivory.google_map.api.javascript.map.marker_cluster',
            ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER
        );

        $this->assertSame('ivory.google_map.api.javascript.map.info_window', ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW);

        $this->assertSame(
            'ivory.google_map.api.javascript.places.autocomplete',
            ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE
        );
    }
}
