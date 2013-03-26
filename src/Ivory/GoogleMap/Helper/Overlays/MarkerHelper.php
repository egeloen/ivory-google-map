<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelper
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\AnimationHelper */
    protected $animationHelper;

    /**
     * Creates a marker helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\AnimationHelper $animationHelper The animation helper.
     */
    public function __construct(AnimationHelper $animationHelper = null)
    {
        if ($animationHelper === null) {
            $animationHelper = new AnimationHelper();
        }

        $this->setAnimationHelper($animationHelper);
    }

    /**
     * Gets the animation helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\AnimationHelper The animation helper.
     */
    public function getAnimationHelper()
    {
        return $this->animationHelper;
    }

    /**
     * Sets the animation helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\AnimationHelper $animationHelper The animation helper.
     */
    public function setAnimationHelper(AnimationHelper $animationHelper)
    {
        $this->animationHelper = $animationHelper;
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
        $markerJSONOptions = sprintf(
            '{"map":%s,"position":%s',
            $map->getJavascriptVariable(),
            $marker->getPosition()->getJavascriptVariable()
        );

        $markerOptions = $marker->getOptions();

        if ($marker->hasAnimation()) {
            $markerJSONOptions .= ', "animation":'.$this->animationHelper->render($marker->getAnimation());
        }

        if ($marker->hasIcon()) {
            $markerJSONOptions .= ', "icon":'.$marker->getIcon()->getJavascriptVariable();
        }

        if ($marker->hasShadow()) {
            $markerJSONOptions .= ', "shadow":'.$marker->getShadow()->getJavascriptVariable();
        }

        if ($marker->hasShape()) {
            $markerJSONOptions .= ', "shape":'.$marker->getShape()->getJavascriptVariable();
        }

        if (!empty($markerOptions)) {
            $markerJSONOptions .= ','.substr(json_encode($markerOptions), 1);
        } else {
            $markerJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.Marker(%s);'.PHP_EOL,
            $marker->getJavascriptVariable(),
            $markerJSONOptions
        );
    }
}
