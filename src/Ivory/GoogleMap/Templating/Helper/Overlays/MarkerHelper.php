<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Map,
    Ivory\GoogleMap\Overlays\Marker,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper;

/**
 * Marker helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\AnimationHelper */
    protected $animationHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper */
    protected $infoWindowHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper */
    protected $markerImageHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerShapeHelper */
    protected $markerShapeHelper;

    /**
     * Creates a marker helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper      $coordinateHelper  The coordinate helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\AnimationHelper   $animationHelper   The animation helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper  $infoWindowHelper  The info window helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper $markerImageHelper The marker image helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerShapeHelper $markerShapeHelper The marker shape helper.
     */
    public function __construct(
        CoordinateHelper $coordinateHelper = null,
        AnimationHelper $animationHelper = null,
        InfoWindowHelper $infoWindowHelper = null,
        MarkerImageHelper $markerImageHelper = null,
        MarkerShapeHelper $markerShapeHelper = null
    )
    {
        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($animationHelper === null) {
            $animationHelper = new AnimationHelper();
        }

        if ($infoWindowHelper === null) {
            $infoWindowHelper = new InfoWindowHelper();
        }

        if ($markerImageHelper === null) {
            $markerImageHelper = new MarkerImageHelper();
        }

        if ($markerShapeHelper === null) {
            $markerShapeHelper = new MarkerShapeHelper();
        }

        $this->setCoordinateHelper($coordinateHelper);
        $this->setAnimationHelper($animationHelper);
        $this->setInfoWindowHelper($infoWindowHelper);
        $this->setMarkerImageHelper($markerImageHelper);
        $this->setMarkerShapeHelper($markerShapeHelper);
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Gets the animation helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\AnimationHelper The animation helper.
     */
    public function getAnimationHelper()
    {
        return $this->animationHelper;
    }

    /**
     * Sets the animation helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\AnimationHelper $animationHelper The animation helper.
     */
    public function setAnimationHelper(AnimationHelper $animationHelper)
    {
        $this->animationHelper = $animationHelper;
    }

    /**
     * Gets the info window helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper The info window helper.
     */
    public function getInfoWindowHelper()
    {
        return $this->infoWindowHelper;
    }

    /**
     * Sets the info window helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper $infoWindowHelper The info window helper.
     */
    public function setInfoWindowHelper(InfoWindowHelper $infoWindowHelper)
    {
        $this->infoWindowHelper = $infoWindowHelper;
    }

    /**
     * Gets the marker image helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper The marker image helper.
     */
    public function getMarkerImageHelper()
    {
        return $this->markerImageHelper;
    }

    /**
     * Sets the marker image helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerImageHelper $markerImageHelper The marker image helper.
     */
    public function setMarkerImageHelper(MarkerImageHelper $markerImageHelper)
    {
        $this->markerImageHelper = $markerImageHelper;
    }

    /**
     * Gets the marker shape helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerShapeHelper The marker shape helper.
     */
    public function getMarkerShapeHelper()
    {
        return $this->markerShapeHelper;
    }

    /**
     * Sets the marker shape helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerShapeHelper $markerShapeHelper The marker shape helper.
     */
    public function setMarkerShapeHelper(MarkerShapeHelper $markerShapeHelper)
    {
        $this->markerShapeHelper = $markerShapeHelper;
    }

    /**
     * Renders a marker.
     *
     * @param Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    public function render(Marker $marker, Map $map)
    {
        $html = array();

        $markerJSONOptions = sprintf('{"map":%s,"position":%s',
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($marker->getPosition())
        );

        $markerOptions = $marker->getOptions();

        if ($marker->hasAnimation()) {
            $markerJSONOptions .= ', "animation":'.$this->animationHelper->render($marker->getAnimation());
        }

        if ($marker->hasIcon()) {
            $html[] = $this->markerImageHelper->render($marker->getIcon());
            $markerJSONOptions .= ', "icon":'.$marker->getIcon()->getJavascriptVariable();
        }

        if ($marker->hasShadow()) {
            $html[] = $this->markerImageHelper->render($marker->getShadow());
            $markerJSONOptions .= ', "shadow":'.$marker->getShadow()->getJavascriptVariable();
        }

        if ($marker->hasShape()) {
            $html[] = $this->markerShapeHelper->render($marker->getShape());
            $markerJSONOptions .= ', "shape":'.$marker->getShape()->getJavascriptVariable();
        }

        if (!empty($markerOptions)) {
            $markerJSONOptions .= ','.substr(json_encode($markerOptions), 1);
        } else {
            $markerJSONOptions .= '}';
        }

        $html[] = sprintf('var %s = new google.maps.Marker(%s);'.PHP_EOL,
            $marker->getJavascriptVariable(),
            $markerJSONOptions
        );

        if ($marker->hasInfoWindow()) {
            $html[] = $this->infoWindowHelper->render($marker->getInfoWindow(), false);

            if ($marker->getInfoWindow()->isOpen()) {
                $html[] = $this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map, $marker);
            }
        }

        return implode('', $html);
    }
}
