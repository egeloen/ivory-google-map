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
    private ?Coordinate $coordinate = null;

    public function __construct(Coordinate $coordinate)
    {
        $this->setCoordinate($coordinate);
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function setCoordinate(Coordinate $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): string
    {
        return $this->coordinate->getLatitude().','.$this->coordinate->getLongitude();
    }
}
