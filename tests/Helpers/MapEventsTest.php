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

use Ivory\GoogleMap\Helpers\MapEvents;

/**
 * Map events test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEventsTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Helpers\MapEvents');
    }

    public function testConstants()
    {
        $this->assertSame('ivory.google_map.map.html', MapEvents::HTML);
        $this->assertSame('ivory.google_map.map.stylesheet', MapEvents::STYLESHEET);
        $this->assertSame('ivory.google_map.map.javascript', MapEvents::JAVASCRIPT);
        $this->assertSame('ivory.google_map.map.javascript.init', MapEvents::JAVASCRIPT_INIT);
        $this->assertSame(
            'ivory.google_map.map.javascript.init.marker_open_event',
            MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT
        );
        $this->assertSame('ivory.google_map.map.javascript.init.container', MapEvents::JAVASCRIPT_INIT_CONTAINER);
        $this->assertSame('ivory.google_map.map.javascript.base', MapEvents::JAVASCRIPT_BASE);
        $this->assertSame('ivory.google_map.map.javascript.base.coordinate', MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $this->assertSame('ivory.google_map.map.javascript.base.bound', MapEvents::JAVASCRIPT_BASE_BOUND);
        $this->assertSame('ivory.google_map.map.javascript.base.point', MapEvents::JAVASCRIPT_BASE_POINT);
        $this->assertSame('ivory.google_map.map.javascript.base.size', MapEvents::JAVASCRIPT_BASE_SIZE);
        $this->assertSame('ivory.google_map.map.javascript.map', MapEvents::JAVASCRIPT_MAP);
        $this->assertSame('ivory.google_map.map.javascript.overlays', MapEvents::JAVASCRIPT_OVERLAYS);
        $this->assertSame('ivory.google_map.map.javascript.overlays.circle', MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE);
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.encoded_polyline',
            MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE
        );
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.ground_overlay',
            MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY
        );
        $this->assertSame('ivory.google_map.map.javascript.overlays.polygon', MapEvents::JAVASCRIPT_OVERLAYS_POLYGON);
        $this->assertSame('ivory.google_map.map.javascript.overlays.polyline', MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE);
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.rectangle',
            MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE
        );
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.info_window',
            MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW
        );
        $this->assertSame('ivory.google_map.map.javascript.overlays.marker_image', MapEvents::JAVASCRIPT_OVERLAYS_ICON);
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.marker_shape',
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE
        );
        $this->assertSame('ivory.google_map.map.javascript.overlays.marker', MapEvents::JAVASCRIPT_OVERLAYS_MARKER);
        $this->assertSame(
            'ivory.google_map.map.javascript.overlays.marker_cluster',
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER
        );
        $this->assertSame('ivory.google_map.map.javascript.layers', MapEvents::JAVASCRIPT_LAYERS);
        $this->assertSame('ivory.google_map.map.javascript.layers.kml_layer', MapEvents::JAVASCRIPT_LAYERS_KML_LAYER);
        $this->assertSame('ivory.google_map.map.javascript.events', MapEvents::JAVASCRIPT_EVENTS);
        $this->assertSame('ivory.google_map.map.javascript.events.dom_event', MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT);
        $this->assertSame(
            'ivory.google_map.map.javascript.events.dom_event_once',
            MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE
        );
        $this->assertSame('ivory.google_map.map.javascript.events.event', MapEvents::JAVASCRIPT_EVENTS_EVENT);
        $this->assertSame('ivory.google_map.map.javascript.events.event_once', MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE);
        $this->assertSame('ivory.google_map.map.javascript.finish', MapEvents::JAVASCRIPT_FINISH);
        $this->assertSame(
            'ivory.google_map.map.javascript.finish.info_window_open',
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN
        );
        $this->assertSame('ivory.google_map.map.javascript.finish.extendable', MapEvents::JAVASCRIPT_FINISH_EXTENDABLE);
        $this->assertSame('ivory.google_map.map.javascript.finish.map_center', MapEvents::JAVASCRIPT_FINISH_MAP_CENTER);
        $this->assertSame('ivory.google_map.map.javascript.finish.map_bound', MapEvents::JAVASCRIPT_FINISH_MAP_BOUND);
    }
}
