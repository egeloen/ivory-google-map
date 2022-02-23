<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Service\UrlSigner;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapHelper extends AbstractHelper
{
    private ?string $secret;

    private ?string $clientId;

    private ?string $channel;

    /**
     * @param string|null $secret
     * @param string|null $clientId
     * @param string|null $channel
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        $secret = null,
        $clientId = null,
        $channel = null
    )
    {
        parent::__construct($eventDispatcher);

        $this->secret   = $secret;
        $this->clientId = $clientId;
        $this->channel  = $channel;
    }

    public function hasSecret(): bool
    {
        return $this->secret !== null;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     */
    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    public function hasClientId(): bool
    {
        return $this->clientId !== null;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param string|null $clientId
     */
    public function setClientId($clientId): void
    {
        $this->clientId = $clientId;
    }

    public function hasChannel(): bool
    {
        return $this->channel !== null;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param string|null $channel
     */
    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

    public function render(Map $map): string
    {
        $this->getEventDispatcher()->dispatch($event = new StaticMapEvent($map), StaticMapEvents::HTML);

        $query = preg_replace('/(%5B[0-9]+%5D)+=/', '=', http_build_query($event->getParameters(), '', '&'));
        $url   = 'https://maps.googleapis.com/maps/api/staticmap?' . $query;

        if ($this->hasSecret()) {
            $url = UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
        }

        return $url;
    }
}
