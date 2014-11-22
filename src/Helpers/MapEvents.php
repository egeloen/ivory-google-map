<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Map events.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEvents extends AbstractUninstantiableAsset
{
    const HTML = 'ivory.google_map.map.html';
    const STYLESHEET = 'ivory.google_map.map.stylesheet';
    const JAVASCRIPT = 'ivory.google_map.map.javascript';
    const JAVASCRIPT_INIT = 'ivory.google_map.map.javascript.init';
    const JAVASCRIPT_INIT_MARKER_OPEN_EVENT = 'ivory.google_map.map.javascript.init.marker_open_event';
    const JAVASCRIPT_INIT_CONTAINER = 'ivory.google_map.map.javascript.init.container';
    const JAVASCRIPT_BASE = 'ivory.google_map.map.javascript.base';
    const JAVASCRIPT_BASE_COORDINATE = 'ivory.google_map.map.javascript.base.coordinate';
    const JAVASCRIPT_BASE_BOUND = 'ivory.google_map.map.javascript.base.bound';
    const JAVASCRIPT_BASE_POINT = 'ivory.google_map.map.javascript.base.point';
    const JAVASCRIPT_BASE_SIZE = 'ivory.google_map.map.javascript.base.size';
    const JAVASCRIPT_MAP = 'ivory.google_map.map.javascript.map';
    const JAVASCRIPT_OVERLAYS = 'ivory.google_map.map.javascript.overlays';
    const JAVASCRIPT_OVERLAYS_CIRCLE = 'ivory.google_map.map.javascript.overlays.circle';
    const JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE = 'ivory.google_map.map.javascript.overlays.encoded_polyline';
    const JAVASCRIPT_OVERLAYS_GROUND_OVERLAY = 'ivory.google_map.map.javascript.overlays.ground_overlay';
    const JAVASCRIPT_OVERLAYS_POLYGON = 'ivory.google_map.map.javascript.overlays.polygon';
    const JAVASCRIPT_OVERLAYS_POLYLINE = 'ivory.google_map.map.javascript.overlays.polyline';
    const JAVASCRIPT_OVERLAYS_RECTANGLE = 'ivory.google_map.map.javascript.overlays.rectangle';
    const JAVASCRIPT_OVERLAYS_INFO_WINDOW = 'ivory.google_map.map.javascript.overlays.info_window';
    const JAVASCRIPT_OVERLAYS_ICON = 'ivory.google_map.map.javascript.overlays.marker_image';
    const JAVASCRIPT_OVERLAYS_MARKER_SHAPE = 'ivory.google_map.map.javascript.overlays.marker_shape';
    const JAVASCRIPT_OVERLAYS_MARKER = 'ivory.google_map.map.javascript.overlays.marker';
    const JAVASCRIPT_OVERLAYS_MARKER_CLUSTER = 'ivory.google_map.map.javascript.overlays.marker_cluster';
    const JAVASCRIPT_LAYERS = 'ivory.google_map.map.javascript.layers';
    const JAVASCRIPT_LAYERS_KML_LAYER = 'ivory.google_map.map.javascript.layers.kml_layer';
    const JAVASCRIPT_EVENTS = 'ivory.google_map.map.javascript.events';
    const JAVASCRIPT_EVENTS_DOM_EVENT = 'ivory.google_map.map.javascript.events.dom_event';
    const JAVASCRIPT_EVENTS_DOM_EVENT_ONCE = 'ivory.google_map.map.javascript.events.dom_event_once';
    const JAVASCRIPT_EVENTS_EVENT = 'ivory.google_map.map.javascript.events.event';
    const JAVASCRIPT_EVENTS_EVENT_ONCE = 'ivory.google_map.map.javascript.events.event_once';
    const JAVASCRIPT_FINISH = 'ivory.google_map.map.javascript.finish';
    const JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE = 'ivory.google_map.map.javascript.finish.info_window_close';
    const JAVASCRIPT_FINISH_INFO_WINDOW_OPEN = 'ivory.google_map.map.javascript.finish.info_window_open';
    const JAVASCRIPT_FINISH_EXTENDABLE = 'ivory.google_map.map.javascript.finish.extendable';
    const JAVASCRIPT_FINISH_MAP_CENTER = 'ivory.google_map.map.javascript.finish.map_center';
    const JAVASCRIPT_FINISH_MAP_BOUND = 'ivory.google_map.map.javascript.finish.map_bound';
}
