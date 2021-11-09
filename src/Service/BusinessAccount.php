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
    private ?string $clientId = null;

    private ?string $secret = null;

    private ?string $channel = null;

    public function __construct(string $clientId, string $secret, ?string $channel = null)
    {
        $this->setClientId($clientId);
        $this->setSecret($secret);
        $this->setChannel($channel);
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }

    public function hasChannel(): bool
    {
        return $this->channel !== null;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(?string $channel = null): void
    {
        $this->channel = $channel;
    }

    public function signUrl(?string $url): string
    {
        return UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
    }
}
