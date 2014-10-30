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
 * Circle.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $center;

    /** @var float */
    private $radius;

    /**
     * Creates a circle.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $center The center.
     * @param float                            $radius The radius.
     */
    public function __construct(Coordinate $center, $radius)
    {
        parent::__construct('circle_');

        $this->setCenter($center);
        $this->setRadius($radius);
    }

    /**
     * Gets the center.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the center.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $center The center.
     */
    public function setCenter(Coordinate $center)
    {
        $this->center = $center;
    }

    /**
     * Gets the radius.
     *
     * @return float The radius.
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Sets the radius.
     *
     * @param float $radius The radius.
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.union(%s.getBounds())', $bound->getVariable(), $this->getVariable());
    }
}
