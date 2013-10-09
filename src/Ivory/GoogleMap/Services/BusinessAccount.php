<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services;

/**
 * Google Map business account.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BusinessAccount
{
    /** @var string */
    protected $clientId;

    /** @var string */
    protected $secret;

    /** @var string */
    protected $channel;

    /**
     * Creates a business account.
     *
     * @param string $clientId The client identifier.
     * @param string $secret   The secret.
     * @param string $channel  The channel.
     */
    public function __construct($clientId, $secret, $channel = null)
    {
        $this->setClientId($clientId);
        $this->setSecret($secret);
        $this->setChannel($channel);
    }

    /**
     * Gets the client identifier.
     *
     * @return string The client identifier.
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Sets the client identifier.
     *
     * @param string $clientId The client identifier.
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Gets the secret.
     *
     * @return string The secret.
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Sets the secret.
     *
     * @param string $secret The secret.
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Checks if the business account has a channel.
     *
     * @return boolean TRUE if the business account has a channel else FALSE.
     */
    public function hasChannel()
    {
        return $this->channel !== null;
    }

    /**
     * Sets the channel.
     *
     * @return string The channel.
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Sets the channel.
     *
     * @param string $channel The channel.
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Sign an url for business purpose.
     *
     * @param string $url The url.
     *
     * @return string The signed url.
     */
    public function signUrl($url)
    {
        $url .= sprintf('&client=gme-%s', $this->clientId);

        if ($this->hasChannel()) {
            $url .= sprintf('&channel=%s', $this->channel);
        }

        $urlParts = parse_url($url);
        $data = sprintf('%s?%s', $urlParts['path'], $urlParts['query']);
        $key = base64_decode(str_replace(array('-', '_'), array('+', '/'), $this->secret));
        $signature = base64_encode(hash_hmac('sha1', $data, $key, true));

        $url .= sprintf('&signature=%s', str_replace(array('+', '/'), array('-', '_'), $signature));

        return $url;
    }
}
