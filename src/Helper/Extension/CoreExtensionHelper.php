<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Extension;

use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper;
use Ivory\GoogleMap\Map;

/**
 * Core extension helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoreExtensionHelper implements ExtensionHelperInterface
{
    /** @var \Ivory\GoogleMap\Helper\ApiHelper */
    protected $apiHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper */
    protected $markerClusterHelper;

    /**
     * Creates a core extension helper.
     *
     * @param \Ivory\GoogleMap\Helper\ApiHelper                                  $apiHelper           The api helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper $markerClusterHelper The marker cluster helper.
     */
    public function __construct(ApiHelper $apiHelper = null, MarkerClusterHelper $markerClusterHelper = null)
    {
        if ($apiHelper === null) {
            $apiHelper = new ApiHelper();
        }

        if ($markerClusterHelper === null) {
            $markerClusterHelper = new MarkerClusterHelper();
        }

        $this->setApiHelper($apiHelper);
        $this->setMarkerClusterHelper($markerClusterHelper);
    }

    /**
     * Gets the api helper.
     *
     * @return \Ivory\GoogleMap\Helper\ApiHelper The api helper.
     */
    public function getApiHelper()
    {
        return $this->apiHelper;
    }

    /**
     * Sets the api helper.
     *
     * @param \Ivory\GoogleMap\Helper\ApiHelper $apiHelper The api helper.
     */
    public function setApiHelper(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
    }

    /**
     * Gets the marker cluster helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper The marker cluster helper.
     */
    public function getMarkerClusterHelper()
    {
        return $this->markerClusterHelper;
    }

    /**
     * Sets the marker cluster helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper $markerClusterHelper The marker cluster helper.
     */
    public function setMarkerClusterHelper(MarkerClusterHelper $markerClusterHelper)
    {
        $this->markerClusterHelper = $markerClusterHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(Map $map)
    {
        if ($this->apiHelper->isLoaded()) {
            return;
        }

        $callback = null;

        if ($map->isAsync()) {
            $callback = 'load_ivory_google_map';
        }

        $output = array();

        $output[] = $this->apiHelper->render($map->getLanguage(), $this->getLibraries($map), $callback, false, $map->getApiKey());
        $output[] = $this->markerClusterHelper->renderLibraries($map->getMarkerCluster(), $map);

        return implode('', $output);
    }

    /**
     * {@inheritdoc}
     */
    public function renderBefore(Map $map)
    {
        if ($map->isAsync()) {
            return 'function load_ivory_google_map() {'.PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderAfter(Map $map)
    {
        if ($map->isAsync()) {
            return '}'.PHP_EOL;
        }
    }

    /**
     * Gets the libraries needed for the map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The map libraries.
     */
    protected function getLibraries(Map $map)
    {
        $libraries = $map->getLibraries();

        $encodedPolylines = $map->getEncodedPolylines();
        if (!empty($encodedPolylines)) {
            $libraries[] = 'geometry';
        }

        return array_unique($libraries);
    }
}
