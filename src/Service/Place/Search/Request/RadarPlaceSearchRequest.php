<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RadarPlaceSearchRequest extends AbstractTextualPlaceSearchRequest
{
    /**
     * @param Coordinate $location
     * @param float      $radius
     */
    public function __construct(Coordinate $location, $radius)
    {
        $this->setLocation($location);
        $this->setRadius($radius);
    }

    /**
     * {@inheritdoc}
     */
    public function buildContext()
    {
        return 'radarsearch';
    }
}
