<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Marker which describes a google map marker.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $position;

    /** @var string */
    protected $animation;

    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $icon;

    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $shadow;

    /** @var \Ivory\GoogleMap\Overlays\MarkerShape */
    protected $shape;

    /** @var \Ivory\GoogleMap\Overlays\InfoWindow */
    protected $infoWindow;

    /**
     * Creates a marker.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate      $position   The marker position.
     * @param string                                $animation  The marker animation.
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $icon       The marker icon.
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $shadow     The marker shadow.
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $shape      The marker shape.
     * @param \Ivory\GoogleMap\Overlays\InfoWindow  $infoWindow The marker info window.
     */
    public function __construct(
        Coordinate $position = null,
        $animation = null,
        MarkerImage $icon = null,
        MarkerImage $shadow = null,
        MarkerShape $shape = null,
        InfoWindow $infoWindow = null
    ) {
        parent::__construct();

        $this->setPrefixJavascriptVariable('marker_');

        if ($position === null) {
            $position = new Coordinate();
        }

        $this->setPosition($position);

        if ($animation !== null) {
            $this->setAnimation($animation);
        }

        if ($icon !== null) {
            $this->setIcon($icon);
        }

        if ($shadow !== null) {
            $this->setShadow($shadow);
        }

        if ($shape !== null) {
            $this->setShape($shape);
        }

        if ($infoWindow !== null) {
            $this->setInfoWindow($infoWindow);
        }
    }

    /**
     * Gets the marker position.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The marker position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the marker position.
     *
     * Available prototypes:
     * - function setPosition(Ivory\GoogleMap\Base\Coordinate $position = null)
     * - function setPosition(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the position is not valid.
     */
    public function setPosition()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->position = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $this->position->setLatitude($args[0]);
            $this->position->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->position->setNoWrap($args[2]);
            }
        } elseif (!isset($args[0])) {
            $this->position = null;
        } else {
            throw OverlayException::invalidMarkerPosition();
        }
    }

    /**
     * Checks if the marker has an animation.
     *
     * @return boolean TRUE if the marker has an animation else FALSE.
     */
    public function hasAnimation()
    {
        return $this->animation !== null;
    }

    /**
     * Gets the marker animation.
     *
     * @return string The marker animation.
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Sets the marker animation.
     *
     * @param string $animation The marker animation.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the animation is not valid.
     */
    public function setAnimation($animation = null)
    {
        if (!in_array($animation, Animation::getAnimations()) && ($animation !== null)) {
            throw OverlayException::invalidMarkerAnimation();
        }

        $this->animation = $animation;
    }

    /**
     * Checks if the marker has an icon.
     *
     * @return boolean TRUE if the marker has an icon else FALSE.
     */
    public function hasIcon()
    {
        return $this->icon !== null;
    }

    /**
     * Gets the marker icon.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerImage The marker image.
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the marker icon.
     *
     * Available prototypes:
     *  - function setIcon(Ivory\GoogleMap\Overlays\MarkerImage $markerImage = null)
     *  - function setIcon(string $url = null)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the icon is not valid.
     */
    public function setIcon()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof MarkerImage)) {
            if ($args[0]->getUrl() === null) {
                throw OverlayException::invalidMarkerIconUrl();
            }

            $this->icon = $args[0];
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->icon === null) {
                $this->icon = new MarkerImage();
            }

            $this->icon->setUrl($args[0]);
        } elseif (!isset($args[0])) {
            $this->icon = null;
        } else {
            throw OverlayException::invalidMarkerIcon();
        }
    }

    /**
     * Checks if the marker has a shadow.
     *
     * @return boolean TRUE if the marker has a shadow else FALSE.
     */
    public function hasShadow()
    {
        return $this->shadow !== null;
    }

    /**
     * Gets the marker shadow.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerImage The marker shadow.
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Sets the marker shadow.
     *
     * Available prototypes:
     *  - function setShadow(Ivory\GoogleMap\Overlays\MarkerImage $markerImage = null)
     *  - function setShadow(string $url = null)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the marker shadow is not valid.
     */
    public function setShadow()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof MarkerImage)) {
            if ($args[0]->getUrl() === null) {
                throw OverlayException::invalidMarkerShadowUrl();
            }

            $this->shadow = $args[0];
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->shadow === null) {
                $this->shadow = new MarkerImage();
            }

            $this->shadow->setUrl($args[0]);
        } elseif (!isset($args[0])) {
            $this->shadow = null;
        } else {
            throw OverlayException::invalidMarkerShadow();
        }
    }

    /**
     * Checks if the marker has a shape.
     *
     * @return boolean TRUE if the marker has a shape else FALSE.
     */
    public function hasShape()
    {
        return $this->shape !== null;
    }

    /**
     * Gets the marker shape.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerShape The marker shape.
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * Sets the marker shape.
     *
     * Available prototypes:
     *  - function setShape(Ivory\GoogleMap\Overlays\MarkerShape $shape = null)
     *  - function setShape(string $type, array $coordinates)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the shape is not valid.
     */
    public function setShape()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof MarkerShape)) {
            if (!$args[0]->hasCoordinates()) {
                throw OverlayException::invalidMarkerShapeCoordinates();
            }

            $this->shape = $args[0];
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_array($args[1]))) {
            if ($this->shape === null) {
                $this->shape = new MarkerShape();
            }

            $this->shape->setType($args[0]);
            $this->shape->setCoordinates($args[1]);
        } elseif (!isset($args[0])) {
            $this->shape = null;
        } else {
            throw OverlayException::invalidMarkerShape();
        }
    }

    /**
     * Check if the marker has an info window.
     *
     * @return boolean TRUE if the marker has an info window else FALSE.
     */
    public function hasInfoWindow()
    {
        return $this->infoWindow !== null;
    }

    /**
     * Gets the info window.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow The info window.
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * Sets the info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    public function setInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindow = $infoWindow;
    }
}
