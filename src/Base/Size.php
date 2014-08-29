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
 * Size which describes a google map size.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Size
 * @author GeLo <geloen.eric@gmail.com>
 */
class Size extends AbstractJavascriptVariableAsset
{
    /** @var double */
    protected $width;

    /** @var double */
    protected $height;

    /** @var string */
    protected $widthUnit;

    /** @var string */
    protected $heightUnit;

    /**
     * Create a size.
     *
     * @param double $width      The width.
     * @param double $height     The height.
     * @param string $widthUnit  The width unit.
     * @param string $heightUnit The height unit.
     */
    public function __construct($width = 1, $height = 1, $widthUnit = null, $heightUnit = null)
    {
        $this->setPrefixJavascriptVariable('size_');

        $this->setWidth($width);
        $this->setHeight($height);

        $this->setWidthUnit($widthUnit);
        $this->setHeightUnit($heightUnit);
    }

    /**
     * Gets the width size.
     *
     * @return double The width size.
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width size.
     *
     * @param double $width The width size.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the width is not valid.
     */
    public function setWidth($width)
    {
        if (!is_numeric($width)) {
            throw BaseException::invalidSizeWidth();
        }

        $this->width = $width;
    }

    /**
     * Gets the height size
     *
     * @return double The height size.
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height size.
     *
     * @param double $height The height size.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the height is not valid.
     */
    public function setHeight($height)
    {
        if (!is_numeric($height)) {
            throw BaseException::invalidSizeHeight();
        }

        $this->height = $height;
    }

    /**
     * Checks if the size has units.
     *
     * @return boolean TRUE if the size has units else FALSE.
     */
    public function hasUnits()
    {
        return ($this->widthUnit !== null) && ($this->heightUnit !== null);
    }

    /**
     * Gets the width unit size.
     *
     * @return string The width unit size.
     */
    public function getWidthUnit()
    {
        return $this->widthUnit;
    }

    /**
     * Sets the width unit size.
     *
     * @param string $widthUnit The width unit size.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the width unit is not valid.
     */
    public function setWidthUnit($widthUnit)
    {
        if (!is_string($widthUnit) && ($widthUnit !== null)) {
            throw BaseException::invalidSizeWidthUnit();
        }

        $this->widthUnit = $widthUnit;
    }

    /**
     * Gets the height unit size.
     *
     * @return string The height unit size.
     */
    public function getHeightUnit()
    {
        return $this->heightUnit;
    }

    /**
     * Sets the height unit size.
     *
     * @param string $heightUnit The height unit size.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the height unit is not valid.
     */
    public function setHeightUnit($heightUnit)
    {
        if (!is_string($heightUnit) && ($heightUnit !== null)) {
            throw BaseException::invalidSizeHeightUnit();
        }

        $this->heightUnit = $heightUnit;
    }
}
