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

use PHPUnit\Framework\MockObject\MockObject;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractHttpService;
use Ivory\GoogleMap\Service\AbstractService;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HttpServiceTest extends TestCase
{
    /** @var MockObject|AbstractHttpService  */
    private MockObject $service;

    /**
     * @var HttpClient|MockObject
     */
    private MockObject $client;

    protected function setUp(): void
    {
        $this->service = $this->getMockBuilder(AbstractHttpService::class)
            ->setConstructorArgs([
                'https://foo',
                $this->client = $this->createHttpClientMock(),
            ])
            ->getMockForAbstractClass();
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(AbstractService::class, $this->service);
        $this->assertSame('https://foo', $this->service->getUrl());
        $this->assertSame($this->client, $this->service->getClient());
    }

    public function testClient()
    {
        $this->service->setClient($client = $this->createHttpClientMock());

        $this->assertSame($client, $this->service->getClient());
    }

    /**
     * @return MockObject|HttpClient
     */
    private function createHttpClientMock()
    {
        return $this->createMock(HttpClient::class);
    }
}
