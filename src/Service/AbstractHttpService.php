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

use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHttpService extends AbstractService
{
    private ?HttpClient $client = null;

    public function __construct(string $url, HttpClient $client)
    {
        parent::__construct($url);

        $this->setClient($client);
    }

    public function getClient(): HttpClient
    {
        return $this->client;
    }

    public function setClient(HttpClient $client)
    {
        $this->client = $client;
    }

    protected function createRequest(RequestInterface $request): PsrRequestInterface
    {
        return new Request('GET', $this->createUrl($request));
    }
}
