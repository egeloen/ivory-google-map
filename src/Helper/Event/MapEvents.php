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
    public const HTML = 'map.html';
    public const STYLESHEET = 'map.stylesheet';
    public const JAVASCRIPT = 'map.javascript';
    public const JAVASCRIPT_INIT = 'map.javascript.init';
    public const JAVASCRIPT_INIT_CONTAINER = 'map.javascript.init.container';
    public const JAVASCRIPT_INIT_FUNCTION = 'map.javascript.init.function';
    public const JAVASCRIPT_BASE = 'map.javascript.base';
    public const JAVASCRIPT_BASE_COORDINATE = 'map.javascript.base.coordinate';
    public const JAVASCRIPT_BASE_BOUND = 'map.javascript.base.bound';
    public const JAVASCRIPT_BASE_POINT = 'map.javascript.base.point';
    public const JAVASCRIPT_BASE_SIZE = 'map.javascript.base.size';
    public const JAVASCRIPT_MAP = 'map.javascript.map';
    public const JAVASCRIPT_OVERLAY = 'map.javascript.overlay';
    public const JAVASCRIPT_OVERLAY_SYMBOL = 'map.javascript.overlay.symbol';
    public const JAVASCRIPT_OVERLAY_ICON = 'map.javascript.overlay.icon';
    public const JAVASCRIPT_OVERLAY_ICON_SEQUENCE = 'map.javascript.overlay.icon_sequence';
    public const JAVASCRIPT_OVERLAY_CIRCLE = 'map.javascript.overlay.circle';
    public const JAVASCRIPT_OVERLAY_ENCODED_POLYLINE = 'map.javascript.overlay.encoded_polyline';
    public const JAVASCRIPT_OVERLAY_GROUND_OVERLAY = 'map.javascript.overlay.ground_overlay';
    public const JAVASCRIPT_OVERLAY_POLYGON = 'map.javascript.overlay.polygon';
    public const JAVASCRIPT_OVERLAY_POLYLINE = 'map.javascript.overlay.polyline';
    public const JAVASCRIPT_OVERLAY_RECTANGLE = 'map.javascript.overlay.rectangle';
    public const JAVASCRIPT_OVERLAY_INFO_WINDOW = 'map.javascript.overlay.info_window';
    public const JAVASCRIPT_OVERLAY_MARKER_SHAPE = 'map.javascript.overlay.marker_shape';
    public const JAVASCRIPT_OVERLAY_MARKER = 'map.javascript.overlay.marker';
    public const JAVASCRIPT_OVERLAY_MARKER_CLUSTER = 'map.javascript.overlay.marker_cluster';
    public const JAVASCRIPT_LAYER = 'map.javascript.layer';
    public const JAVASCRIPT_LAYER_GEO_JSON_LAYER = 'map.javascript.layer.geo_json_layer';
    public const JAVASCRIPT_LAYER_HEATMAP_LAYER = 'map.javascript.layer.heatmap_layer';
    public const JAVASCRIPT_LAYER_KML_LAYER = 'map.javascript.layer.kml_layer';
    public const JAVASCRIPT_CONTROL = 'map.javascript.control';
    public const JAVASCRIPT_CONTROL_CUSTOM = 'map.javascript.control.custom';
    public const JAVASCRIPT_EVENT = 'map.javascript.event';
    public const JAVASCRIPT_EVENT_DOM_EVENT = 'map.javascript.event.dom_event';
    public const JAVASCRIPT_EVENT_DOM_EVENT_ONCE = 'map.javascript.event.dom_event_once';
    public const JAVASCRIPT_EVENT_EVENT = 'map.javascript.event.event';
    public const JAVASCRIPT_EVENT_EVENT_ONCE = 'map.javascript.event.event_once';
    public const JAVASCRIPT_FINISH = 'map.javascript.finish';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
