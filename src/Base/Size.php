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

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Size
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Size implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $height;

    /**
     * @var string
     */
    private $widthUnit;

    /**
     * @var string
     */
    private $heightUnit;

    /**
     * @param float       $width
     * @param float       $height
     * @param string|null $widthUnit
     * @param string|null $heightUnit
     */
    public function __construct($width = 1.0, $height = 1.0, $widthUnit = null, $heightUnit = null)
    {
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setWidthUnit($widthUnit);
        $this->setHeightUnit($heightUnit);
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return bool
     */
    public function hasUnits()
    {
        return $this->hasWidthUnit() && $this->hasHeightUnit();
    }

    /**
     * @return bool
     */
    public function hasWidthUnit()
    {
        return $this->widthUnit !== null;
    }

    /**
     * @return string|null
     */
    public function getWidthUnit()
    {
        return $this->widthUnit;
    }

    /**
     * @param string|null $widthUnit
     */
    public function setWidthUnit($widthUnit = null)
    {
        $this->widthUnit = $widthUnit;
    }

    /**
     * @return bool
     */
    public function hasHeightUnit()
    {
        return $this->heightUnit !== null;
    }

    /**
     * @return string|null
     */
    public function getHeightUnit()
    {
        return $this->heightUnit;
    }

    /**
     * @param string|null $heightUnit
     */
    public function setHeightUnit($heightUnit = null)
    {
        $this->heightUnit = $heightUnit;
    }
}
