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
abstract class AbstractHttpService extends AbstractService
{
    private ?HttpClient $client = null;

    private ?MessageFactory $messageFactory = null;

    public function __construct(string $url, HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($url);

        $this->setClient($client);
        $this->setMessageFactory($messageFactory);
    }

    public function getClient(): HttpClient
    {
        return $this->client;
    }

    public function setClient(HttpClient $client)
    {
        $this->client = $client;
    }

    public function getMessageFactory(): MessageFactory
    {
        return $this->messageFactory;
    }

    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    protected function createRequest(RequestInterface $request): \Psr\Http\Message\RequestInterface
    {
        return $this->messageFactory->createRequest('GET', $this->createUrl($request));
    }
}
