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
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Ground overlay which describes a google map ground overlay.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlay
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlay extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    protected $url;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * Creates a ground overlay.
     *
     * @param string                      $url   The ground overlay url.
     * @param \Ivory\GoogleMap\Base\Bound $bound The ground overlay bound.
     */
    public function __construct($url = null, Bound $bound = null)
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('ground_overlay_');

        if ($url !== null) {
            $this->setUrl($url);
        }

        if ($bound === null) {
            $bound = new Bound(new Coordinate(-1, -1), new Coordinate(1, 1));
        }

        $this->setBound($bound);
    }

    /**
     * Gets the ground overlay image url.
     *
     * @return string The ground overlay image url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the ground overlay image url.
     *
     * @param string $url The ground overlay image url.
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw OverlayException::invalidGroundOverlayUrl();
        }

        $this->url = $url;
    }

    /**
     * Gets the ground overlay bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The ground overlay bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the ground overlay bound.
     *
     * Available prototypes:
     *  - function setBound(Ivory\GoogleMap\Base\Bound $bound)
     *  - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     *  - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     *  )
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the ground overlay bound is not valid (prototypes).
     */
    public function setBound()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Bound)) {
            if ($args[0]->hasCoordinates()) {
                $this->bound = $args[0];
            } else {
                throw OverlayException::invalidGroundOverlayBoundCoordinates();
            }
        } elseif ((isset($args[0]) && ($args[0] instanceof Coordinate))
            && (isset($args[1]) && ($args[1] instanceof Coordinate))
        ) {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        } elseif ((isset($args[0]) && is_numeric($args[0]))
            && (isset($args[1]) && is_numeric($args[1]))
            && (isset($args[2]) && is_numeric($args[2]))
            && (isset($args[3]) && is_numeric($args[3]))
        ) {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));

            if (isset($args[4]) && is_bool($args[4])) {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            }

            if (isset($args[5]) && is_bool($args[5])) {
                $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        } else {
            throw OverlayException::invalidGroundOverlayBound();
        }
    }
}
