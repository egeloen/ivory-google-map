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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerCluster;

/**
 * Javascript marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsMarkerClusterHelper extends DefaultMarkerClusterHelper
{
    /**
     * {@inheritdoc}
     */
    public function render(MarkerCluster $markerCluster, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValues($markerCluster->getOptions());

        return sprintf('%s = new MarkerClusterer(%s, %s, %s);'.PHP_EOL,
            $markerCluster->getJavascriptVariable(),
            $map->getJavascriptVariable(),
            sprintf(
                '%s.functions.to_array(%s.markers)',
                $this->getJsContainerName($map),
                $this->getJsContainerName($map)
            ),
            $this->jsonBuilder->build()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map)
    {
        $url = '//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js';

        return sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL, $url);
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
            $this->markerHelper->render($marker)
        );
    }
}
