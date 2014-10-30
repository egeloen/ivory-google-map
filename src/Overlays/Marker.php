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
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * Marker.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $position;

    /** @var string|null */
    private $animation;

    /** @var \Ivory\GoogleMap\Overlays\Icon|null */
    private $icon;

    /** @var \Ivory\GoogleMap\Overlays\Icon|null */
    private $shadow;

    /** @var \Ivory\GoogleMap\Overlays\MarkerShape|null */
    private $shape;

    /** @var \Ivory\GoogleMap\Overlays\InfoWindow|null */
    private $infoWindow;

    /**
     * Creates a marker.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $position The position.
     */
    public function __construct(Coordinate $position)
    {
        parent::__construct('marker_');

        $this->setPosition($position);
    }

    /**
     * Gets the position.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $position The position.
     */
    public function setPosition(Coordinate $position)
    {
        $this->position = $position;
    }

    /**
     * Checks if there is an animation.
     *
     * @return boolean TRUE if there is an animation else FALSE.
     */
    public function hasAnimation()
    {
        return $this->animation !== null;
    }

    /**
     * Gets the animation.
     *
     * @return string|null The animation.
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Sets the animation.
     *
     * @param string|null $animation The animation.
     */
    public function setAnimation($animation = null)
    {
        $this->animation = $animation;
    }

    /**
     * Checks if there is an icon.
     *
     * @return boolean TRUE if there is an icon else FALSE.
     */
    public function hasIcon()
    {
        return $this->icon !== null;
    }

    /**
     * Gets the icon.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|null The icon.
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the icon.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon|null $icon The icon.
     */
    public function setIcon(Icon $icon = null)
    {
        $this->icon = $icon;
    }

    /**
     * Checks if there is a shadow.
     *
     * @return boolean TRUE if there is a shadow else FALSE.
     */
    public function hasShadow()
    {
        return $this->shadow !== null;
    }

    /**
     * Gets the shadow.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|null The shadow.
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Sets the shadow.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon|null $shadow The shadow.
     */
    public function setShadow(Icon $shadow = null)
    {
        $this->shadow = $shadow;
    }

    /**
     * Checks if there is a shape.
     *
     * @return boolean TRUE if there is a shape else FALSE.
     */
    public function hasShape()
    {
        return $this->shape !== null;
    }

    /**
     * Gets the shape.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerShape|null The shape.
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * Sets the shape.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape|null $shape The shape.
     */
    public function setShape(MarkerShape $shape = null)
    {
        $this->shape = $shape;
    }

    /**
     * Check if there is an info window.
     *
     * @return boolean TRUE if there is an info window else FALSE.
     */
    public function hasInfoWindow()
    {
        return $this->infoWindow !== null;
    }

    /**
     * Gets the info window.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|null The info window.
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * Sets the info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow|null $infoWindow The info window.
     */
    public function setInfoWindow(InfoWindow $infoWindow = null)
    {
        $this->infoWindow = $infoWindow;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.extend(%s.getPosition())', $bound->getVariable(), $this->getVariable());
    }
}
