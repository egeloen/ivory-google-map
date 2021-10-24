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
    private ?string $encodedPolyline = null;

    /**
     * @param string $encodedPolyline
     */
    public function __construct($encodedPolyline)
    {
        $this->setEncodedPolyline($encodedPolyline);
    }

    public function getEncodedPolyline(): string
    {
        return $this->encodedPolyline;
    }

    /**
     * @param string $encodedPolyline
     */
    public function setEncodedPolyline($encodedPolyline): void
    {
        $this->encodedPolyline = $encodedPolyline;
    }

    public function buildQuery(): string
    {
        return 'enc:'.$this->encodedPolyline;
    }
}
