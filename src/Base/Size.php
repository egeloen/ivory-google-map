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
 * Size.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Size
 * @author GeLo <geloen.eric@gmail.com>
 */
class Size extends AbstractVariableAsset
{
    /** @var float */
    private $width;

    /** @var float */
    private $height;

    /** @var string|null */
    private $widthUnit;

    /** @var string|null */
    private $heightUnit;

    /**
     * Creates a size.
     *
     * @param float       $width      The width.
     * @param float       $height     The height.
     * @param string|null $widthUnit  The width unit.
     * @param string|null $heightUnit The height unit.
     */
    public function __construct($width, $height, $widthUnit = null, $heightUnit = null)
    {
        parent::__construct('size_');

        $this->setWidth($width);
        $this->setHeight($height);
        $this->setWidthUnit($widthUnit);
        $this->setHeightUnit($heightUnit);
    }

    /**
     * Gets the width.
     *
     * @return float The width.
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width.
     *
     * @param float $width The width.
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Gets the height.
     *
     * @return float The height.
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height.
     *
     * @param float $height The height.
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Checks if there is a width unit.
     *
     * @return boolean TRUE if there is a width unit else FALSE.
     */
    public function hasWidthUnit()
    {
        return $this->widthUnit !== null;
    }

    /**
     * Gets the width unit.
     *
     * @return string|null The width unit.
     */
    public function getWidthUnit()
    {
        return $this->widthUnit;
    }

    /**
     * Sets the width unit.
     *
     * @param string|null $widthUnit The width unit.
     */
    public function setWidthUnit($widthUnit)
    {
        $this->widthUnit = $widthUnit;
    }

    /**
     * Checks if there is an height unit.
     *
     * @return boolean TRUE if there is an height unit else FALSE.
     */
    public function hasHeightUnit()
    {
        return $this->heightUnit !== null;
    }

    /**
     * Gets the height unit.
     *
     * @return string|null The height unit.
     */
    public function getHeightUnit()
    {
        return $this->heightUnit;
    }

    /**
     * Sets the height unit.
     *
     * @param string|null $heightUnit The height unit.
     */
    public function setHeightUnit($heightUnit)
    {
        $this->heightUnit = $heightUnit;
    }
}
