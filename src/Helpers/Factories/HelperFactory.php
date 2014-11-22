<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Factories;

use Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator;
use Ivory\GoogleMap\Helpers\ApiHelper;
use Ivory\GoogleMap\Helpers\MapHelper;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer;
use Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\ApiJavascriptSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Base\BaseSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Base\BoundSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Base\CoordinateSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Base\PointSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Base\SizeSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventOnceSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventOnceSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventsSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;
use Ivory\GoogleMap\Helpers\Subscribers\Layers\KmlLayerSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Layers\LayersSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapBoundSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapCenterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapContainerSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapFinishSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapHtmlSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapInitSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapJavascriptSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapStylesheetSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\MapSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\CircleSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\EncodedPolylineSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\ExtendableSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\GroundOverlaySubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\IconSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowCloseSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowOpenSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerClusterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerOpenEventSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerShapeSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\OverlaysSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolygonSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolylineSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\RectangleSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBaseSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBoundSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteContainerSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteCoordinateSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteHtmlSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteInitSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteJavascriptSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteSubscriber;
use Ivory\JsonBuilder\JsonBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Helper factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperFactory extends AbstractHelperFactory
{
    /** @var \Ivory\JsonBuilder\JsonBuilder */
    private $jsonBuilder;

    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Formatter */
    private $formatter;

    /** @var array */
    private $aggregators = array();

    /** @var array */
    private $renderers = array();

    /** @var array */
    private $subscribers = array();

    /**
     * {@inheritdoc}
     */
    public function __construct($debug = false, $indentation = 4)
    {
        $this->setJsonBuilder(new JsonBuilder());
        $this->setFormatter(new Formatter());

        parent::__construct($debug, $indentation);

        $this->resetAggregators();
        $this->resetRenderers();
        $this->resetSubscribers();
    }

    /**
     * {@inheritdoc}
     */
    public function setDebug($debug)
    {
        $this->formatter->setDebug($debug);
        parent::setDebug($debug);
    }

    /**
     * {@inheritdoc}
     */
    public function setIndentation($indentation)
    {
        $this->formatter->setIndentation($indentation);
        parent::setIndentation($indentation);
    }

    /**
     * Gets the json builder.
     *
     * @return \Ivory\JsonBuilder\JsonBuilder The json builder.
     */
    public function getJsonBuilder()
    {
        return $this->jsonBuilder;
    }

    /**
     * Sets the json builder.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder)
    {
        $this->jsonBuilder = $jsonBuilder;

        foreach ($this->renderers as $renderer) {
            if ($renderer instanceof AbstractJsonRenderer) {
                $renderer->setJsonBuilder($jsonBuilder);
            }
        }
    }

    /**
     * Gets the formatter.
     *
     * @return \Ivory\GoogleMap\Helpers\Subscribers\Formatter The formatter.
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * Sets the formatter.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter $formatter The formatter.
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;

        foreach ($this->subscribers as $subscriber) {
            if ($subscriber instanceof AbstractFormatterSubscriber) {
                $subscriber->setFormatter($formatter);
            }
        }
    }

    /**
     * Resets the aggregators.
     */
    public function resetAggregators()
    {
        $this->aggregators = array();

        $this->aggregators['autocomplete_bound'] = new AutocompleteBoundAggregator();
        $this->aggregators['autocomplete_coordinate'] = new AutocompleteCoordinateAggregator(
            $this->aggregators['autocomplete_bound']
        );

        $this->aggregators['marker'] = new MarkerAggregator();
        $this->aggregators['circle'] = new CircleAggregator();
        $this->aggregators['encoded_polyline'] = new EncodedPolylineAggregator();
        $this->aggregators['extendable'] = new ExtendableAggregator();
        $this->aggregators['ground_overlay'] = new GroundOverlayAggregator();
        $this->aggregators['icon'] = new IconAggregator($this->aggregators['marker']);
        $this->aggregators['info_window'] = new InfoWindowAggregator($this->aggregators['marker']);
        $this->aggregators['marker_shape'] = new MarkerShapeAggregator($this->aggregators['marker']);
        $this->aggregators['polygon'] = new PolygonAggregator();
        $this->aggregators['polyline'] = new PolylineAggregator();
        $this->aggregators['rectangle'] = new RectangleAggregator();

        $this->aggregators['kml_layer'] = new KmlLayerAggregator();

        $this->aggregators['dom_event_once'] = new DomEventOnceAggregator();
        $this->aggregators['dom_event'] = new DomEventAggregator();
        $this->aggregators['event_once'] = new EventOnceAggregator();
        $this->aggregators['event'] = new EventAggregator();

        $this->aggregators['bound'] = new BoundAggregator(
            $this->aggregators['ground_overlay'],
            $this->aggregators['rectangle']
        );

        $this->aggregators['coordinate'] = new CoordinateAggregator(
            $this->aggregators['bound'],
            $this->aggregators['circle'],
            $this->aggregators['info_window'],
            $this->aggregators['marker'],
            $this->aggregators['polygon'],
            $this->aggregators['polyline']
        );

        $this->aggregators['point'] = new PointAggregator($this->aggregators['marker']);
        $this->aggregators['size'] = new SizeAggregator(
            $this->aggregators['info_window'],
            $this->aggregators['icon']
        );
    }

    /**
     * Checks if there are aggregators.
     *
     * @return boolean TRUE if there are aggragtors else FALSE.
     */
    public function hasAggregators()
    {
        return !empty($this->aggregators);
    }

    /**
     * Gets the aggregators.
     *
     * @return array The aggregators.
     */
    public function getAggregators()
    {
        return $this->aggregators;
    }

    /**
     * Sets the aggregators.
     *
     * @param array $aggregators The aggregators.
     */
    public function setAggregators(array $aggregators)
    {
        $this->resetAggregators();
        $this->addAggregators($aggregators);
    }

    /**
     * Adds the aggregators.
     *
     * @param array $aggregators The aggregators.
     */
    public function addAggregators(array $aggregators)
    {
        foreach ($aggregators as $name => $aggregator) {
            $this->setAggregator($name, $aggregator);
        }
    }

    /**
     * Removes the aggregators.
     *
     * @param array $names The names.
     */
    public function removeAggregators(array $names)
    {
        foreach ($names as $name) {
            $this->removeAggregator($name);
        }
    }

    /**
     * Checks if there is an aggregator.
     *
     * @param string $name The name.
     *
     * @return boolean TRUE if there is the aggregator else FALSE.
     */
    public function hasAggregator($name)
    {
        return isset($this->aggregators[$name]);
    }

    /**
     * Gets an agregator.
     *
     * @param string $name The aggregator name.
     *
     * @return object|null The aggregator.
     */
    public function getAggregator($name)
    {
        return $this->hasAggregator($name) ? $this->aggregators[$name] : null;
    }

    /**
     * Sets an aggregators.
     *
     * @param string $name       The name.
     * @param object $aggregator The aggregator.
     */
    public function setAggregator($name, $aggregator)
    {
        $this->aggregators[$name] = $aggregator;

        switch ($name) {
            case 'bound':
                $this->aggregators['coordinate']->setBoundAggregator($aggregator);
                $this->subscribers['bound']->setBoundAggregator($aggregator);
                break;

            case 'circle':
                $this->aggregators['coordinate']->setCircleAggregator($aggregator);
                $this->subscribers['circle']->setCircleAggregator($aggregator);
                break;

            case 'coordinate':
                $this->subscribers['coordinate']->setCoordinateAggregator($aggregator);
                break;

            case 'dom_event':
                $this->subscribers['dom_event']->setDomEventAggregator($aggregator);
                break;

            case 'dom_event_once':
                $this->subscribers['dom_event_once']->setDomEventOnceAggregator($aggregator);
                break;

            case 'encoded_polyline':
                $this->subscribers['encoded_polyline']->setEncodedPolylineAggregator($aggregator);
                break;

            case 'event':
                $this->subscribers['event']->setEventAggregator($aggregator);
                break;

            case 'event_once':
                $this->subscribers['event_once']->setEventOnceAggregator($aggregator);
                break;

            case 'extendable':
                $this->subscribers['extendable']->setExtendableAggregator($aggregator);
                break;

            case 'ground_overlay':
                $this->aggregators['bound']->setGroundOverlayAggregator($aggregator);
                $this->subscribers['ground_overlay']->setGroundOverlayAggregator($aggregator);
                break;

            case 'icon':
                $this->aggregators['size']->setIconAggregator($aggregator);
                $this->subscribers['icon']->setIconAggregator($aggregator);
                break;

            case 'info_window':
                foreach (array('coordinate', 'size') as $value) {
                    $this->aggregators[$value]->setInfoWindowAggregator($aggregator);
                }

                foreach (array('info_window_close', 'info_window_open', 'info_window') as $value) {
                    $this->subscribers[$value]->setInfoWindowAggregator($aggregator);
                }
                break;

            case 'kml_layer':
                $this->subscribers['kml_layer']->setKmlLayerAggregator($aggregator);
                break;

            case 'marker':
                foreach (array('coordinate', 'icon', 'info_window', 'marker_shape', 'point') as $value) {
                    $this->aggregators[$value]->setMarkerAggregator($aggregator);
                }

                foreach (array('marker_open_event', 'marker') as $value) {
                    $this->subscribers[$value]->setMarkerAggregator($aggregator);
                }
                break;

            case 'marker_shape':
                $this->subscribers['marker_shape']->setMarkerShapeAggregator($aggregator);
                break;

            case 'point':
                $this->subscribers['point']->setPointAggregator($aggregator);
                break;

            case 'size':
                $this->subscribers['size']->setSizeAggregator($aggregator);
                break;

            case 'polygon':
                $this->aggregators['coordinate']->setPolygonAggregator($aggregator);
                $this->subscribers['polygon']->setPolygonAggregator($aggregator);
                break;

            case 'polyline':
                $this->aggregators['coordinate']->setPolylineAggregator($aggregator);
                $this->subscribers['polyline']->setPolylineAggregator($aggregator);
                break;

            case 'rectangle':
                $this->aggregators['bound']->setRectangleAggregator($aggregator);
                $this->subscribers['rectangle']->setRectangleAggregator($aggregator);
                break;

            case 'autocomplete_bound':
                $this->aggregators['autocomplete_coordinate']->setBoundAggregator($aggregator);
                $this->subscribers['autocomplete_bound']->setBoundAggregator($aggregator);
                break;

            case 'autocomplete_coordinate':
                $this->subscribers['autocomplete_coordinate']->setCoordinateAggregator($aggregator);
                break;
        }
    }

    /**
     * Removes an aggregator.
     *
     * @param string $name The name.
     */
    public function removeAggregator($name)
    {
        $aggregators = array(
            'autocomplete_bound',
            'autocomplete_coordinate',
            'marker',
            'circle',
            'encoded_polyline',
            'extendable',
            'ground_overlay',
            'icon',
            'info_window',
            'marker_shape',
            'polygon',
            'polyline',
            'rectangle',
            'kml_layer',
            'dom_event_once',
            'dom_event',
            'event_once',
            'event',
            'bound',
            'ground_overlay',
            'rectangle',
            'coordinate',
            'bound',
            'circle',
            'info_window',
            'marker',
            'polygon',
            'polyline',
            'point',
            'size',
        );

        if (!in_array($name, $aggregators, true)) {
            unset($this->aggregators[$name]);
        }
    }

    /**
     * Resets the renderers.
     */
    public function resetRenderers()
    {
        $this->renderers = array();

        $this->renderers['bound'] = new BoundRenderer();
        $this->renderers['coordinate'] = new CoordinateRenderer();
        $this->renderers['point'] = new PointRenderer();
        $this->renderers['size'] = new SizeRenderer();

        $this->renderers['dom_event_once'] = new DomEventOnceRenderer();
        $this->renderers['dom_event'] = new DomEventRenderer();
        $this->renderers['event_once'] = new EventOnceRenderer();
        $this->renderers['event'] = new EventRenderer();

        $this->renderers['encoding'] = new EncodingRenderer();

        $this->renderers['kml_layer'] = new KmlLayerRenderer($this->jsonBuilder);

        $this->renderers['animation'] = new AnimationRenderer();
        $this->renderers['circle'] = new CircleRenderer($this->jsonBuilder);

        $this->renderers['encoded_polyline'] = new EncodedPolylineRenderer(
            $this->jsonBuilder,
            $this->renderers['encoding']
        );

        $this->renderers['extendable'] = new ExtendableRenderer();
        $this->renderers['ground_overlay'] = new GroundOverlayRenderer($this->jsonBuilder);
        $this->renderers['icon'] = new IconRenderer($this->jsonBuilder);
        $this->renderers['info_window_close'] = new InfoWindowCloseRenderer();
        $this->renderers['info_window_open'] = new InfoWindowOpenRenderer();
        $this->renderers['info_window'] = new InfoWindowRenderer($this->jsonBuilder);
        $this->renderers['info_box'] = new InfoBoxRenderer($this->jsonBuilder);
        $this->renderers['marker_cluster'] = new MarkerClusterRenderer($this->jsonBuilder);
        $this->renderers['marker_shape'] = new MarkerShapeRenderer($this->jsonBuilder);
        $this->renderers['marker'] = new MarkerRenderer($this->jsonBuilder, $this->renderers['animation']);
        $this->renderers['polygon'] = new PolygonRenderer($this->jsonBuilder);
        $this->renderers['polyline'] = new PolylineRenderer($this->jsonBuilder);
        $this->renderers['rectangle'] = new RectangleRenderer($this->jsonBuilder);

        $this->renderers['autocomplete_container'] = new AutocompleteContainerRenderer($this->jsonBuilder);
        $this->renderers['autocomplete'] = new AutocompleteRenderer($this->jsonBuilder);

        $this->renderers['loader'] = new LoaderRenderer($this->jsonBuilder);

        $this->renderers['map_bound'] = new MapBoundRenderer();
        $this->renderers['map_center'] = new MapCenterRenderer();
        $this->renderers['map_container'] = new MapContainerRenderer($this->jsonBuilder);
        $this->renderers['map_type_id'] = new MapTypeIdRenderer();

        $this->renderers['control_position'] = new ControlPositionRenderer();
        $this->renderers['map_type_control_style'] = new MapTypeControlStyleRenderer();
        $this->renderers['overview_map_control'] = new OverviewMapControlRenderer($this->jsonBuilder);

        $this->renderers['pan_control'] = new PanControlRenderer(
            $this->jsonBuilder,
            $this->renderers['control_position']
        );

        $this->renderers['rotate_control'] = new RotateControlRenderer(
            $this->jsonBuilder,
            $this->renderers['control_position']
        );

        $this->renderers['scale_control_style'] = new ScaleControlStyleRenderer();

        $this->renderers['scale_control'] = new ScaleControlRenderer(
            $this->jsonBuilder,
            $this->renderers['scale_control_style']
        );

        $this->renderers['street_view_control'] = new StreetViewControlRenderer(
            $this->jsonBuilder,
            $this->renderers['control_position']
        );

        $this->renderers['zoom_control_style'] = new ZoomControlStyleRenderer();

        $this->renderers['zoom_control'] = new ZoomControlRenderer(
            $this->jsonBuilder,
            $this->renderers['control_position'],
            $this->renderers['zoom_control_style']
        );

        $this->renderers['map_type_control'] = new MapTypeControlRenderer(
            $this->jsonBuilder,
            $this->renderers['map_type_id'],
            $this->renderers['control_position'],
            $this->renderers['map_type_control_style']
        );

        $this->renderers['controls'] = new ControlsRenderer(
            $this->renderers['map_type_control'],
            $this->renderers['overview_map_control'],
            $this->renderers['pan_control'],
            $this->renderers['rotate_control'],
            $this->renderers['scale_control'],
            $this->renderers['street_view_control'],
            $this->renderers['zoom_control']
        );

        $this->renderers['map'] = new MapRenderer(
            $this->jsonBuilder,
            $this->renderers['map_type_id'],
            $this->renderers['controls']
        );
    }

    /**
     * Checks if there are renderers.
     *
     * @return boolean TRUE if there are renderers else FALSE.
     */
    public function hasRenderers()
    {
        return !empty($this->renderers);
    }

    /**
     * Gets the renderers.
     *
     * @return array The renderers.
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * Sets the renderers.
     *
     * @param array $renderers The renderers.
     */
    public function setRenderers(array $renderers)
    {
        $this->resetRenderers();
        $this->addRenderers($renderers);
    }

    /**
     * Adds the renderers.
     *
     * @param array $renderers The renderers.
     */
    public function addRenderers(array $renderers)
    {
        foreach ($renderers as $name => $renderer) {
            $this->setRenderer($name, $renderer);
        }
    }

    /**
     * Removes the renderers.
     *
     * @param array $names The names.
     */
    public function removeRenderers(array $names)
    {
        foreach ($names as $name) {
            $this->removeRenderer($name);
        }
    }

    /**
     * Checks if there is a renderer.
     *
     * @param string $name The name.
     *
     * @return boolean TRUE if there is the renderer else FALSE.
     */
    public function hasRenderer($name)
    {
        return isset($this->renderers[$name]);
    }

    /**
     * Gets a renderer.
     *
     * @param string $name The name.
     *
     * @return object|null The renderer.
     */
    public function getRenderer($name)
    {
        return $this->hasRenderer($name) ? $this->renderers[$name] : null;
    }

    /**
     * Sets the renderer.
     *
     * @param string $name     The name.
     * @param object $renderer The renderer.
     */
    public function setRenderer($name, $renderer)
    {
        $this->renderers[$name] = $renderer;

        switch ($name) {
            case 'animation':
                $this->renderers['marker']->setAnimationRenderer($renderer);
                break;

            case 'autocomplete':
                $this->subscribers['autocomplete']->setAutocompleteRenderer($renderer);
                break;

            case 'autocomplete_container':
                $this->subscribers['autocomplete_container']->setContainerRenderer($renderer);
                break;

            case 'bound':
                foreach (array('bound', 'autocomplete_bound') as $value) {
                    $this->subscribers[$value]->setBoundRenderer($renderer);
                }
                break;

            case 'circle':
                $this->subscribers['circle']->setCircleRenderer($renderer);
                break;

            case 'coordinate':
                foreach (array('coordinate', 'autocomplete_coordinate') as $value) {
                    $this->subscribers[$value]->setCoordinateRenderer($renderer);
                }
                break;

            case 'controls':
                $this->renderers['map']->setControlsRenderer($renderer);
                break;

            case 'control_position':
                $values = array(
                    'map_type_control',
                    'pan_control',
                    'rotate_control',
                    'street_view_control',
                    'zoom_control',
                );

                foreach ($values as $value) {
                    $this->renderers[$value]->setControlPositionRenderer($renderer);
                }
                break;

            case 'dom_event':
                $this->subscribers['dom_event']->setDomEventRenderer($renderer);
                break;

            case 'dom_event_once':
                $this->subscribers['dom_event_once']->setDomEventOnceRenderer($renderer);
                break;

            case 'encoded_polyline':
                $this->subscribers['encoded_polyline']->setEncodedPolylineRenderer($renderer);
                break;

            case 'encoding':
                $this->renderers['encoded_polyline']->setEncodingRenderer($renderer);
                break;

            case 'event':
                $this->subscribers['event']->setEventRenderer($renderer);
                break;

            case 'event_once':
                $this->subscribers['event_once']->setEventOnceRenderer($renderer);
                break;

            case 'extendable':
                $this->subscribers['extendable']->setExtendableRenderer($renderer);
                break;

            case 'ground_overlay':
                $this->subscribers['ground_overlay']->setGroundOverlayRenderer($renderer);
                break;

            case 'icon':
                $this->subscribers['icon']->setIconRenderer($renderer);
                break;

            case 'info_box':
                $this->subscribers['info_window']->setInfoBoxRenderer($renderer);
                break;

            case 'info_window':
                $this->subscribers['info_window']->setInfoWindowRenderer($renderer);
                break;

            case 'info_window_close':
                $this->subscribers['info_window_close']->setInfoWindowCloseRenderer($renderer);
                break;

            case 'info_window_open':
                foreach (array('info_window_open', 'marker_open_event') as $value) {
                    $this->subscribers[$value]->setInfoWindowOpenRenderer($renderer);
                }
                break;

            case 'kml_layer':
                $this->subscribers['kml_layer']->setKmlLayerRenderer($renderer);
                break;

            case 'loader':
                $this->subscribers['api_javascript']->setLoaderRenderer($renderer);
                break;

            case 'map':
                $this->subscribers['map']->setMapRenderer($renderer);
                break;

            case 'map_bound':
                $this->subscribers['map_bound']->setMapBoundRenderer($renderer);
                break;

            case 'map_center':
                $this->subscribers['map_center']->setMapCenterRenderer($renderer);
                break;

            case 'map_container':
                $this->subscribers['map_container']->setContainerRenderer($renderer);
                break;

            case 'map_type_control':
                $this->renderers['controls']->setMapTypeControlRenderer($renderer);
                break;

            case 'map_type_control_style':
                $this->renderers['map_type_control']->setMapTypeControlStyleRenderer($renderer);
                break;

            case 'map_type_id':
                foreach (array('map_type_control', 'map') as $value) {
                    $this->renderers[$value]->setMapTypeIdRenderer($renderer);
                }
                break;

            case 'marker':
                $this->subscribers['marker']->setMarkerRenderer($renderer);
                break;

            case 'marker_cluster':
                $this->subscribers['marker_cluster']->setMarkerClusterRenderer($renderer);
                break;

            case 'marker_shape':
                $this->subscribers['marker_shape']->setMarkerShapeRenderer($renderer);
                break;

            case 'overview_map_control':
                $this->renderers['controls']->setOverviewMapControlRenderer($renderer);
                break;

            case 'pan_control':
                $this->renderers['controls']->setPanControlRenderer($renderer);
                break;

            case 'point':
                $this->subscribers['point']->setPointRenderer($renderer);
                break;

            case 'polygon':
                $this->subscribers['polygon']->setPolygonRenderer($renderer);
                break;

            case 'polyline':
                $this->subscribers['polyline']->setPolylineRenderer($renderer);
                break;

            case 'rectangle':
                $this->subscribers['rectangle']->setRectangleRenderer($renderer);
                break;

            case 'rotate_control':
                $this->renderers['controls']->setRotateControlRenderer($renderer);
                break;

            case 'scale_control':
                $this->renderers['controls']->setScaleControlRenderer($renderer);
                break;

            case 'scale_control_style':
                $this->renderers['scale_control']->setScaleControlStyleRenderer($renderer);
                break;

            case 'size':
                $this->subscribers['size']->setSizeRenderer($renderer);
                break;

            case 'street_view_control':
                $this->renderers['controls']->setStreetViewControlRenderer($renderer);
                break;

            case 'zoom_control':
                $this->renderers['controls']->setZoomControlRenderer($renderer);
                break;

            case 'zoom_control_style':
                $this->renderers['zoom_control']->setZoomControlStyleRenderer($renderer);
                break;
        }
    }

    /**
     * Removes a renderer.
     *
     * @param string $name The name.
     */
    public function removeRenderer($name)
    {
        $renderers = array(
            'bound',
            'coordinate',
            'point',
            'size',
            'dom_event_once',
            'dom_event',
            'event_once',
            'event',
            'encoding',
            'kml_layer',
            'animation',
            'circle',
            'encoded_polyline',
            'extendable',
            'ground_overlay',
            'icon',
            'info_window_close',
            'info_window_open',
            'info_window',
            'info_box',
            'marker_cluster',
            'marker_shape',
            'marker',
            'polygon',
            'polyline',
            'rectangle',
            'autocomplete_container',
            'autocomplete',
            'loader',
            'map_bound',
            'map_center',
            'map_container',
            'map_type_id',
            'control_position',
            'map_type_control_style',
            'overview_map_control',
            'pan_control',
            'rotate_control',
            'scale_control_style',
            'scale_control',
            'street_view_control',
            'zoom_control_style',
            'zoom_control',
            'map_type_control',
            'controls',
            'map',
        );

        if (!in_array($name, $renderers, true)) {
            unset($this->renderers[$name]);
        }
    }

    /**
     * Resets the subscribers.
     */
    public function resetSubscribers()
    {
        $this->subscribers = array();

        $this->subscribers['base'] = new BaseSubscriber();
        $this->subscribers['events'] = new EventsSubscriber();
        $this->subscribers['layers'] = new LayersSubscriber();
        $this->subscribers['overlays'] = new OverlaysSubscriber();
        $this->subscribers['autocomplete_base'] = new AutocompleteBaseSubscriber();

        $this->subscribers['bound'] = new BoundSubscriber(
            $this->formatter,
            $this->aggregators['bound'],
            $this->renderers['bound']
        );

        $this->subscribers['coordinate'] = new CoordinateSubscriber(
            $this->formatter,
            $this->aggregators['coordinate'],
            $this->renderers['coordinate']
        );

        $this->subscribers['point'] = new PointSubscriber(
            $this->formatter,
            $this->aggregators['point'],
            $this->renderers['point']
        );

        $this->subscribers['size'] = new SizeSubscriber(
            $this->formatter,
            $this->aggregators['size'],
            $this->renderers['size']
        );

        $this->subscribers['dom_event_once'] = new DomEventOnceSubscriber(
            $this->formatter,
            $this->aggregators['dom_event_once'],
            $this->renderers['dom_event_once']
        );

        $this->subscribers['dom_event'] = new DomEventSubscriber(
            $this->formatter,
            $this->aggregators['dom_event'],
            $this->renderers['dom_event']
        );

        $this->subscribers['event_once'] = new EventOnceSubscriber(
            $this->formatter,
            $this->aggregators['event_once'],
            $this->renderers['event_once']
        );

        $this->subscribers['event'] = new EventSubscriber(
            $this->formatter,
            $this->aggregators['event'],
            $this->renderers['event']
        );

        $this->subscribers['kml_layer'] = new KmlLayerSubscriber(
            $this->formatter,
            $this->aggregators['kml_layer'],
            $this->renderers['kml_layer']
        );

        $this->subscribers['circle'] = new CircleSubscriber(
            $this->formatter,
            $this->aggregators['circle'],
            $this->renderers['circle']
        );

        $this->subscribers['encoded_polyline'] = new EncodedPolylineSubscriber(
            $this->formatter,
            $this->aggregators['encoded_polyline'],
            $this->renderers['encoded_polyline']
        );

        $this->subscribers['extendable'] = new ExtendableSubscriber(
            $this->formatter,
            $this->aggregators['extendable'],
            $this->renderers['extendable']
        );

        $this->subscribers['ground_overlay'] = new GroundOverlaySubscriber(
            $this->formatter,
            $this->aggregators['ground_overlay'],
            $this->renderers['ground_overlay']
        );

        $this->subscribers['icon'] = new IconSubscriber(
            $this->formatter,
            $this->aggregators['icon'],
            $this->renderers['icon']
        );

        $this->subscribers['info_window_close'] = new InfoWindowCloseSubscriber(
            $this->formatter,
            $this->aggregators['info_window'],
            $this->renderers['info_window_close']
        );

        $this->subscribers['info_window_open'] = new InfoWindowOpenSubscriber(
            $this->formatter,
            $this->aggregators['info_window'],
            $this->renderers['info_window_open']
        );

        $this->subscribers['info_window'] = new InfoWindowSubscriber(
            $this->formatter,
            $this->aggregators['info_window'],
            $this->renderers['info_window'],
            $this->renderers['info_box']
        );

        $this->subscribers['marker_cluster'] = new MarkerClusterSubscriber(
            $this->formatter,
            $this->renderers['marker_cluster']
        );

        $this->subscribers['marker_open_event'] = new MarkerOpenEventSubscriber(
            $this->formatter,
            $this->aggregators['marker'],
            $this->renderers['info_window_open']
        );

        $this->subscribers['marker_shape'] = new MarkerShapeSubscriber(
            $this->formatter,
            $this->aggregators['marker_shape'],
            $this->renderers['marker_shape']
        );

        $this->subscribers['marker'] = new MarkerSubscriber(
            $this->formatter,
            $this->aggregators['marker'],
            $this->renderers['marker']
        );

        $this->subscribers['polygon'] = new PolygonSubscriber(
            $this->formatter,
            $this->aggregators['polygon'],
            $this->renderers['polygon']
        );

        $this->subscribers['polyline'] = new PolylineSubscriber(
            $this->formatter,
            $this->aggregators['polyline'],
            $this->renderers['polyline']
        );

        $this->subscribers['rectangle'] = new RectangleSubscriber(
            $this->formatter,
            $this->aggregators['rectangle'],
            $this->renderers['rectangle']
        );

        $this->subscribers['autocomplete_bound'] = new AutocompleteBoundSubscriber(
            $this->formatter,
            $this->aggregators['autocomplete_bound'],
            $this->renderers['bound']
        );

        $this->subscribers['autocomplete_coordinate'] = new AutocompleteCoordinateSubscriber(
            $this->formatter,
            $this->aggregators['autocomplete_coordinate'],
            $this->renderers['coordinate']
        );

        $this->subscribers['autocomplete_container'] = new AutocompleteContainerSubscriber(
            $this->formatter,
            $this->renderers['autocomplete_container']
        );

        $this->subscribers['autocomplete_html'] = new AutocompleteHtmlSubscriber($this->formatter);
        $this->subscribers['autocomplete_init'] = new AutocompleteInitSubscriber();
        $this->subscribers['autocomplete_javascript'] = new AutocompleteJavascriptSubscriber($this->formatter);

        $this->subscribers['autocomplete'] = new AutocompleteSubscriber(
            $this->formatter,
            $this->renderers['autocomplete']
        );

        $this->subscribers['api_javascript'] = new ApiJavascriptSubscriber(
            $this->formatter,
            $this->renderers['loader']
        );

        $this->subscribers['map_bound'] = new MapBoundSubscriber($this->formatter, $this->renderers['map_bound']);
        $this->subscribers['map_center'] = new MapCenterSubscriber($this->formatter, $this->renderers['map_center']);

        $this->subscribers['map_container'] = new MapContainerSubscriber(
            $this->formatter,
            $this->renderers['map_container']
        );

        $this->subscribers['map_finish'] = new MapFinishSubscriber();
        $this->subscribers['map_html'] = new MapHtmlSubscriber($this->formatter);
        $this->subscribers['map_init'] = new MapInitSubscriber();
        $this->subscribers['map_javascript'] = new MapJavascriptSubscriber($this->formatter);
        $this->subscribers['map_stylesheet'] = new MapStylesheetSubscriber($this->formatter);
        $this->subscribers['map'] = new MapSubscriber($this->formatter, $this->renderers['map']);
    }

    /**
     * Checks if there are subscribers.
     *
     * @return boolean TRUE if there are subscribers else FALSE.
     */
    public function hasSubscribers()
    {
        return !empty($this->subscribers);
    }

    /**
     * Gets the subscribers.
     *
     * @return array The subscribers.
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Sets the subscribers.
     *
     * @param array $subscribers The subscribers.
     */
    public function setSubscribers(array $subscribers)
    {
        $this->resetSubscribers();
        $this->addSubscribers($subscribers);
    }

    /**
     * Adds the subscribers.
     *
     * @param array $subscribers The subscribers.
     */
    public function addSubscribers(array $subscribers)
    {
        foreach ($subscribers as $name => $subscriber) {
            $this->setSubscriber($name, $subscriber);
        }
    }

    /**
     * Removes the subscribers.
     *
     * @param array $names The names.
     */
    public function removeSubscribers(array $names)
    {
        foreach ($names as $name) {
            $this->removeSubscriber($name);
        }
    }

    /**
     * Checks if there is a subscriber.
     *
     * @param string $name The name.
     *
     * @return boolean TRUE if there is a subscriber else FALSE.
     */
    public function hasSubscriber($name)
    {
        return isset($this->subscribers[$name]);
    }

    /**
     * Gets a subscriber.
     *
     * @param string $name The name.
     *
     * @return \Symfony\Component\EventDispatcher\EventSubscriberInterface|null The subscriber.
     */
    public function getSubscriber($name)
    {
        return $this->hasSubscriber($name) ? $this->subscribers[$name] : null;
    }

    /**
     * Sets a subscrber.
     *
     * @param string                                                      $name       The name.
     * @param \Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber The subscriber.
     */
    public function setSubscriber($name, EventSubscriberInterface $subscriber)
    {
        $this->subscribers[$name] = $subscriber;
    }

    /**
     * Removes a subscriber.
     *
     * @param string $name The name.
     */
    public function removeSubscriber($name)
    {
        unset($this->subscribers[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function createApiHelper()
    {
        return new ApiHelper($this->createEventDispatcher());
    }

    /**
     * {@inheritdoc}
     */
    public function createMapHelper()
    {
        return new MapHelper($this->createEventDispatcher());
    }

    /**
     * {@inheritdoc}
     */
    public function createPlacesAutocompleteHelper()
    {
        return new PlacesAutocompleteHelper($this->createEventDispatcher());
    }

    /**
     * Creates an event dispatcher.
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcher The event dispatcher.
     */
    private function createEventDispatcher()
    {
        $eventDispatcher = new EventDispatcher();
        foreach ($this->subscribers as $subscriber) {
            $eventDispatcher->addSubscriber($subscriber);
        }

        return $eventDispatcher;
    }
}
