<?php

/**
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Events\Event;
use Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerCluster;

/**
 * Default marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultMarkerClusterHelper extends AbstractMarkerClusterHelper
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper */
    protected $infoWindowHelper;

    /**
     * Creates a default marker cluster helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerHelper $markerHelper     The marker helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper           $infoWindowHelper The info window helper.
     */
    public function __construct(MarkerHelper $markerHelper = null, InfoWindowHelper $infoWindowHelper = null)
    {
        parent::__construct($markerHelper);

        if ($infoWindowHelper === null) {
            $infoWindowHelper = new InfoWindowHelper();
        }

        $this->setInfoWindowHelper($infoWindowHelper);
    }

    /**
     * Gets the info window helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper The info window helper.
     */
    public function getInfoWindowHelper()
    {
        return $this->infoWindowHelper;
    }

    /**
     * Sets the info window helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper $infoWindowHelper The info window helper.
     */
    public function setInfoWindowHelper(InfoWindowHelper $infoWindowHelper)
    {
        $this->infoWindowHelper = $infoWindowHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function render(MarkerCluster $markerCluster, Map $map)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function renderMarkers(MarkerCluster $markerCluster, Map $map)
    {
        $output = array();

        foreach ($markerCluster->getMarkers() as $marker) {
            $output[] = $this->renderMarker($marker, $map);

            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoOpen()) {
                $this->registerInfoWindowEvent($marker, $map);
            }
        }

        return implode('', $output);
    }

    /**
     * Renders a marker with the js map container.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    protected function renderMarker(Marker $marker, Map $map)
    {
        return sprintf(
            '%s.markers.%s = %s',
            $this->getJsContainerName($map),
            $marker->getJavascriptVariable(),
            $this->markerHelper->render($marker, $map)
        );
    }

    /**
     * Registers the info window event (auto open).
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     */
    protected function registerInfoWindowEvent(Marker $marker, Map $map)
    {
        $closableInfoWindows = sprintf('%s.closable_info_windows', $this->getJsContainerName($map));

        $handle = <<<EOF
function () {
    for (var info_window in {$closableInfoWindows}) {
        {$closableInfoWindows}[info_window].close();
    }
    {$this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map, $marker)}
}
EOF;

        $event = new Event();
        $event->setJavascriptVariable(sprintf('%s_%s', $marker->getJavascriptVariable(), 'info_window_event'));
        $event->setInstance($marker->getJavascriptVariable());
        $event->setEventName($marker->getInfoWindow()->getOpenEvent());
        $event->setHandle($handle);

        $map->getEventManager()->addEvent($event);
    }
}
