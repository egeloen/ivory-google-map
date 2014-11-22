<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Base;

use Ivory\GoogleMap\Assets\AbstractVariableAsset;

/**
 * Point.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Point
 * @author GeLo <geloen.eric@gmail.com>
 */
class Point extends AbstractVariableAsset
{
    /** @var float */
    private $x;

    /** @var float */
    private $y;

    /**
     * Creates a point.
     *
     * @param float $x The X.
     * @param float $y The Y.
     */
    public function __construct($x, $y)
    {
        parent::__construct('point_');

        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Gets the X.
     *
     * @return float The X.
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets the X.
     *
     * @param float $x The X.
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * Gets the Y.
     *
     * @return float The Y.
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Sets the Y.
     *
     * @param float $y The Y.
     */
    public function setY($y)
    {
        $this->y = $y;
    }
}
