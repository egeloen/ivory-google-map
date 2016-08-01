<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BusinessAccount
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $channel;

    /**
     * @param string $clientId
     * @param string $secret
     * @param string $channel
     */
    public function __construct($clientId, $secret, $channel = null)
    {
        $this->setClientId($clientId);
        $this->setSecret($secret);
        $this->setChannel($channel);
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
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
    public function setChannel($channel = null)
    {
        $this->channel = $channel;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function signUrl($url)
    {
        $url .= '&client=gme-'.$this->clientId;

        if ($this->hasChannel()) {
            $url .= '&channel='.$this->channel;
        }

        $urlParts = parse_url($url);
        $data = $urlParts['path'].'?'.$urlParts['query'];
        $key = base64_decode(str_replace(['-', '_'], ['+', '/'], $this->secret));
        $signature = base64_encode(hash_hmac('sha1', $data, $key, true));

        return $url.'&signature='.str_replace(['+', '/'], ['-', '_'], $signature);
    }
}
