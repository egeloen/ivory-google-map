<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base\Location;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateLocation implements LocationInterface
{
    /**
     * @var Coordinate
     */
    private $coordinate;

    /**
     * @param Coordinate $coordinate
     */
    public function __construct(Coordinate $coordinate)
    {
        $this->setCoordinate($coordinate);
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @param Coordinate $coordinate
     */
    public function setCoordinate(Coordinate $coordinate)
    {
        $this->coordinate = $coordinate;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        return $this->coordinate->getLatitude().','.$this->coordinate->getLongitude();
    }
}
