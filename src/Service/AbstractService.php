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
abstract class AbstractService
{
    private ?string $url = null;

    private ?string $key = null;

    private ?BusinessAccount $businessAccount = null;

    public function __construct(string $url)
    {
        $this->setUrl($url);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function hasKey(): bool
    {
        return $this->key !== null;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    public function hasBusinessAccount(): bool
    {
        return $this->businessAccount !== null;
    }

    public function getBusinessAccount(): ?BusinessAccount
    {
        return $this->businessAccount;
    }

    public function setBusinessAccount(BusinessAccount $businessAccount = null)
    {
        $this->businessAccount = $businessAccount;
    }

    protected function createUrl(RequestInterface $request): string
    {
        $query = $request->buildQuery();

        if ($this->hasKey()) {
            $query['key'] = $this->key;
        }

        $url = $this->createBaseUrl($request).'?'.http_build_query($query, '', '&');

        if ($this->hasBusinessAccount()) {
            $url = $this->businessAccount->signUrl($url);
        }

        return $url;
    }

    protected function createBaseUrl(RequestInterface $request): string
    {
        $url = $this->getUrl();

        if ($request instanceof ContextualizedRequestInterface) {
            $url .= '/'.$request->buildContext();
        }

        return $url;
    }
}
