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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Exception\BaseException;

/**
 * Point which describes a google map point
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Point
 * @author GeLo <geloen.eric@gmail.com>
 */
class Point extends AbstractJavascriptVariableAsset
{
    /** @var double */
    protected $x;

    /** @var double */
    protected $y;

    /**
     * Creates a point.
     *
     * @param double $x X coordinate.
     * @param double $y Y coordinate.
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->setPrefixJavascriptVariable('point_');

        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Gets the x coordinate.
     *
     * @return double The x coordinate.
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets the x coordinate.
     *
     * @param double $x The x coordinate.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the X coordinate is not valid.
     */
    public function setX($x)
    {
        if (!is_numeric($x)) {
            throw BaseException::invalidPointX();
        }

        $this->x = $x;
    }

    /**
     * Gets the y coordinate.
     *
     * @return double The Y coordinate.
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Sets the y coordinate.
     *
     * @param double $y The y coordinate.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the Y coordinate is not valid.
     */
    public function setY($y)
    {
        if (!is_numeric($y)) {
            throw BaseException::invalidPointY();
        }

        $this->y = $y;
    }
}
