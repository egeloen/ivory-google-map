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
 * Circle which describes a google map circle.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $center;

    /** @var double */
    protected $radius;

    /**
     * Create a circle.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $center The circle center.
     * @param double                           $radius The circle radius.
     */
    public function __construct(Coordinate $center = null, $radius = 1)
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('circle_');

        if ($center === null) {
            $center = new Coordinate();
        }

        $this->setCenter($center);
        $this->setRadius($radius);
    }

    /**
     * Gets the circle center.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The circle center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the circle center.
     *
     * Available prototypes:
     *  - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     *  - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the center is not valid (prototypes).
     */
    public function setCenter()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->center = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->center->setNoWrap($args[2]);
            }
        } else {
            throw OverlayException::invalidCircleCenter();
        }
    }

    /**
     * Gets the circle radius.
     *
     * @return double The circle radius.
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Sets the circle radius.
     *
     * @param double $radius The circle radius.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the radius is not valid.
     */
    public function setRadius($radius)
    {
        if (!is_numeric($radius)) {
            throw OverlayException::invalidCircleRadius();
        }

        $this->radius = $radius;
    }
}
