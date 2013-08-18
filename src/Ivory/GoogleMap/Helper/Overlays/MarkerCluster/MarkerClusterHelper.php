<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Exception\HelperException;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\MarkerCluster;

/**
 * Marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterHelper implements MarkerClusterHelperInterface
{
    /** @var array */
    protected $helpers;

    /**
     * Creates a marker cluster helper.
     */
    public function __construct(array $helpers = array())
    {
        if (empty($helpers)) {
            $helpers = array(
                MarkerCluster::_DEFAULT       => new DefaultMarkerClusterHelper(),
                MarkerCluster::MARKER_CLUSTER => new JsMarkerClusterHelper(),
            );
        }

        $this->setHelpers($helpers);
    }

    /**
     * Checks if the marker cluster helper has helpers.
     *
     * @return boolean TRUE if the marker cluster helper has helpers else FALSE.
     */
    public function hasHelpers()
    {
        return !empty($this->helpers);
    }

    /**
     * Gets the marker cluster helper helpers.
     *
     * @return array The marker cluster helper helpers.
     */
    public function getHelpers()
    {
        return $this->helpers;
    }

    /**
     * Sets the marker cluster helper helpers.
     *
     * @param array $helpers The marker cluster helper helpers.
     */
    public function setHelpers(array $helpers)
    {
        $this->helpers = array();

        foreach ($helpers as $name => $helper) {
            $this->setHelper($name, $helper);
        }
    }

    /**
     * Checks if the marker cluster helper has a specific helper.
     *
     * @param string $name The marker cluster type.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface The marker cluster helper.
     */
    public function hasHelper($name)
    {
        return isset($this->helpers[$name]);
    }

    /**
     * Gets a specific marker cluster helper.
     *
     * @param string $name The marker cluster type.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the helper does not exist.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface The marker cluster helper.
     */
    public function getHelper($name)
    {
        if (!$this->hasHelper($name)) {
            throw HelperException::invalidMarkerClusterHelper();
        }

        return $this->helpers[$name];
    }

    /**
     * Sets a specific marker cluster helper.
     *
     * @param string                                                                      $name   The marker cluster type.
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface $helper The marker cluster helper.
     */
    public function setHelper($name, MarkerClusterHelperInterface $helper = null)
    {
        $this->helpers[$name] = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function render(MarkerCluster $markerCluster, Map $map)
    {
        return $this->getHelper($markerCluster->getType())->render($markerCluster, $map);
    }

    /**
     * {@inheritdoc}
     */
    public function renderMarkers(MarkerCluster $markerCluster, Map $map)
    {
        return $this->getHelper($markerCluster->getType())->renderMarkers($markerCluster, $map);
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map)
    {
        return $this->getHelper($markerCluster->getType())->renderLibraries($markerCluster, $map);
    }
}
