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
class AddressLocation implements LocationInterface
{
    private ?string $address = null;

    /**
     * @param string $address
     */
    public function __construct($address)
    {
        $this->setAddress($address);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function buildQuery(): string
    {
        return $this->address;
    }
}
