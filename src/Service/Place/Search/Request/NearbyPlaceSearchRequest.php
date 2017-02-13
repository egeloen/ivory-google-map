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
class NearbyPlaceSearchRequest extends AbstractTextualPlaceSearchRequest
{
    /**
     * @var string
     */
    private $rankBy;

    /**
     * @param Coordinate $location
     * @param string     $rankBy
     * @param float|null $radius
     */
    public function __construct(Coordinate $location, $rankBy, $radius = null)
    {
        $this->setLocation($location);
        $this->setRankBy($rankBy);
        $this->setRadius($radius);
    }

    /**
     * @return string
     */
    public function getRankBy()
    {
        return $this->rankBy;
    }

    /**
     * @param string $rankBy
     */
    public function setRankBy($rankBy)
    {
        $this->rankBy = $rankBy;
    }

    /**
     * {@inheritdoc}
     */
    public function buildContext()
    {
        return 'nearbysearch';
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = parent::buildQuery();
        $query['rankby'] = $this->rankBy;

        return $query;
    }
}
