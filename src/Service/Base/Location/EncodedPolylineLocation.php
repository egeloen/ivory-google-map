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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineLocation implements LocationInterface
{
    /**
     * @var string
     */
    private $encodedPolyline;

    /**
     * @param string $encodedPolyline
     */
    public function __construct($encodedPolyline)
    {
        $this->setEncodedPolyline($encodedPolyline);
    }

    /**
     * @return string
     */
    public function getEncodedPolyline()
    {
        return $this->encodedPolyline;
    }

    /**
     * @param string $encodedPolyline
     */
    public function setEncodedPolyline($encodedPolyline)
    {
        $this->encodedPolyline = $encodedPolyline;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        return 'enc:'.$this->encodedPolyline;
    }
}
