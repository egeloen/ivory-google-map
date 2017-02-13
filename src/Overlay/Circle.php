<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var Coordinate
     */
    private $center;

    /**
     * @var float
     */
    private $radius;

    /**
     * @param Coordinate $center
     * @param float      $radius
     * @param mixed[]    $options
     */
    public function __construct(Coordinate $center, $radius = 1.0, array $options = [])
    {
        $this->setCenter($center);
        $this->setRadius($radius);
        $this->addOptions($options);
    }

    /**
     * @return Coordinate
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * @param Coordinate $center
     */
    public function setCenter(Coordinate $center)
    {
        $this->center = $center;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }
}
