<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service;

use Http\Client\HttpClient;
use Ivory\GoogleMap\Service\BusinessAccount;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractUnitServiceTest extends TestCase
{
    /** @var HttpClient|MockObject */
    protected MockObject $client;
    /** @var SerializerInterface|MockObject */
    protected MockObject $serializer;

    protected function setUp(): void
    {
        $this->client     = $this->createHttpClientMock();
        $this->serializer = $this->createSerializerMock();
    }

    /**
     * @return MockObject|HttpClient
     */
    protected function createHttpClientMock()
    {
        return $this->createMock(HttpClient::class);
    }

    /**
     * @return MockObject|SerializerInterface
     */
    protected function createSerializerMock()
    {
        return $this->createMock(SerializerInterface::class);
    }

    /**
     * @return MockObject|RequestInterface
     */
    protected function createHttpRequestMock()
    {
        return $this->createMock(RequestInterface::class);
    }

    /**
     * @return MockObject|ResponseInterface
     */
    protected function createHttpResponseMock()
    {
        return $this->createMock(ResponseInterface::class);
    }

    /**
     * @return MockObject|StreamInterface
     */
    protected function createHttpStreamMock()
    {
        return $this->createMock(StreamInterface::class);
    }

    /**
     * @return MockObject|BusinessAccount
     */
    protected function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }
}
