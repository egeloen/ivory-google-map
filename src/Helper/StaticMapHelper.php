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
    /**
     * @var string|null
     */
    private $secret;

    /**
     * @var string|null
     */
    private $clientId;

    /**
     * @var string|null
     */
    private $channel;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param string|null              $secret
     * @param string|null              $clientId
     * @param string|null              $channel
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        $secret = null,
        $clientId = null,
        $channel = null
    ) {
        parent::__construct($eventDispatcher);

        $this->secret = $secret;
        $this->clientId = $clientId;
        $this->channel = $channel;
    }

    /**
     * @return bool
     */
    public function hasSecret()
    {
        return $this->secret !== null;
    }

    /**
     * @return string|null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return bool
     */
    public function hasClientId()
    {
        return $this->clientId !== null;
    }

    /**
     * @return string|null
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string|null $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return bool
     */
    public function hasChannel()
    {
        return $this->channel !== null;
    }

    /**
     * @return string|null
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string|null $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @param Map $map
     *
     * @return string
     */
    public function render(Map $map)
    {
        $this->getEventDispatcher()->dispatch(StaticMapEvents::HTML, $event = new StaticMapEvent($map));

        $query = preg_replace('/(%5B[0-9]+%5D)+=/', '=', http_build_query($event->getParameters(), '', '&'));
        $url = 'https://maps.googleapis.com/maps/api/staticmap?'.$query;

        if ($this->hasSecret()) {
            $url = UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
        }

        return $url;
    }
}
