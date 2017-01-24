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

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var string|null
     */
    private $key;

    /**
     * @var BusinessAccount|null
     */
    private $businessAccount;

    /**
     * @param string         $url
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct($url, HttpClient $client, MessageFactory $messageFactory)
    {
        $this->setUrl($url);
        $this->setClient($client);
        $this->setMessageFactory($messageFactory);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return HttpClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param HttpClient $client
     */
    public function setClient(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return MessageFactory
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param MessageFactory $messageFactory
     */
    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return bool
     */
    public function hasKey()
    {
        return $this->key !== null;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return bool
     */
    public function hasBusinessAccount()
    {
        return $this->businessAccount !== null;
    }

    /**
     * @return BusinessAccount
     */
    public function getBusinessAccount()
    {
        return $this->businessAccount;
    }

    /**
     * @param BusinessAccount $businessAccount
     */
    public function setBusinessAccount(BusinessAccount $businessAccount = null)
    {
        $this->businessAccount = $businessAccount;
    }

    /**
     * @param RequestInterface $request
     *
     * @return PsrRequestInterface
     */
    protected function createRequest(RequestInterface $request)
    {
        $query = $request->buildQuery();

        if ($this->hasKey()) {
            $query['key'] = $this->key;
        }

        $url = $this->createUrl($request).'?'.http_build_query($query, '', '&');

        if ($this->hasBusinessAccount()) {
            $url = $this->businessAccount->signUrl($url);
        }

        return $this->messageFactory->createRequest('GET', $url);
    }

    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    protected function createUrl(RequestInterface $request)
    {
        $url = $this->getUrl();

        if ($request instanceof ContextualizedRequestInterface) {
            $url .= '/'.$request->buildContext();
        }

        return $url;
    }
}
