<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class MapEvents
{
    const HTML = 'map.html';
    const STYLESHEET = 'map.stylesheet';
    const JAVASCRIPT = 'map.javascript';
    const JAVASCRIPT_INIT = 'map.javascript.init';
    const JAVASCRIPT_INIT_CONTAINER = 'map.javascript.init.container';
    const JAVASCRIPT_INIT_FUNCTION = 'map.javascript.init.function';
    const JAVASCRIPT_BASE = 'map.javascript.base';
    const JAVASCRIPT_BASE_COORDINATE = 'map.javascript.base.coordinate';
    const JAVASCRIPT_BASE_BOUND = 'map.javascript.base.bound';
    const JAVASCRIPT_BASE_POINT = 'map.javascript.base.point';
    const JAVASCRIPT_BASE_SIZE = 'map.javascript.base.size';
    const JAVASCRIPT_MAP = 'map.javascript.map';
    const JAVASCRIPT_OVERLAY = 'map.javascript.overlay';
    const JAVASCRIPT_OVERLAY_SYMBOL = 'map.javascript.overlay.symbol';
    const JAVASCRIPT_OVERLAY_ICON = 'map.javascript.overlay.icon';
    const JAVASCRIPT_OVERLAY_ICON_SEQUENCE = 'map.javascript.overlay.icon_sequence';
    const JAVASCRIPT_OVERLAY_CIRCLE = 'map.javascript.overlay.circle';
    const JAVASCRIPT_OVERLAY_ENCODED_POLYLINE = 'map.javascript.overlay.encoded_polyline';
    const JAVASCRIPT_OVERLAY_GROUND_OVERLAY = 'map.javascript.overlay.ground_overlay';
    const JAVASCRIPT_OVERLAY_POLYGON = 'map.javascript.overlay.polygon';
    const JAVASCRIPT_OVERLAY_POLYLINE = 'map.javascript.overlay.polyline';
    const JAVASCRIPT_OVERLAY_RECTANGLE = 'map.javascript.overlay.rectangle';
    const JAVASCRIPT_OVERLAY_INFO_WINDOW = 'map.javascript.overlay.info_window';
    const JAVASCRIPT_OVERLAY_MARKER_SHAPE = 'map.javascript.overlay.marker_shape';
    const JAVASCRIPT_OVERLAY_MARKER = 'map.javascript.overlay.marker';
    const JAVASCRIPT_OVERLAY_MARKER_CLUSTER = 'map.javascript.overlay.marker_cluster';
    const JAVASCRIPT_LAYER = 'map.javascript.layer';
    const JAVASCRIPT_LAYER_GEO_JSON_LAYER = 'map.javascript.layer.geo_json_layer';
    const JAVASCRIPT_LAYER_HEATMAP_LAYER = 'map.javascript.layer.heatmap_layer';
    const JAVASCRIPT_LAYER_KML_LAYER = 'map.javascript.layer.kml_layer';
    const JAVASCRIPT_CONTROL = 'map.javascript.control';
    const JAVASCRIPT_CONTROL_CUSTOM = 'map.javascript.control.custom';
    const JAVASCRIPT_EVENT = 'map.javascript.event';
    const JAVASCRIPT_EVENT_DOM_EVENT = 'map.javascript.event.dom_event';
    const JAVASCRIPT_EVENT_DOM_EVENT_ONCE = 'map.javascript.event.dom_event_once';
    const JAVASCRIPT_EVENT_EVENT = 'map.javascript.event.event';
    const JAVASCRIPT_EVENT_EVENT_ONCE = 'map.javascript.event.event_once';
    const JAVASCRIPT_FINISH = 'map.javascript.finish';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
