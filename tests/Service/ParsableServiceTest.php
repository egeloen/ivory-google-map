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
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractParsableService;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ParsableServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractParsableService|\PHPUnit_Framework_MockObject_MockObject
     */
    private $service;

    /**
     * @var HttpClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * @var MessageFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $messageFactory;

    /**
     * @var string
     */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->service = $this->getMockBuilder(AbstractParsableService::class)
            ->setConstructorArgs([
                $this->client = $this->createHttpClientMock(),
                $this->messageFactory = $this->createMessageFactoryMock(),
                $this->url = 'http://foo',
            ])
            ->getMockForAbstractClass();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractService::class, $this->service);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->client, $this->service->getClient());
        $this->assertSame($this->messageFactory, $this->service->getMessageFactory());
        $this->assertSame('https://foo', $this->service->getUrl());
        $this->assertTrue($this->service->isHttps());
        $this->assertSame(AbstractParsableService::FORMAT_JSON, $this->service->getFormat());
        $this->assertInstanceOf(Parser::class, $this->service->getParser());
        $this->assertTrue($this->service->getParser()->hasParsers());
        $this->assertTrue($this->service->getParser()->hasParser(Parser::FORMAT_JSON));
        $this->assertTrue($this->service->getParser()->hasParser(Parser::FORMAT_XML));
        $this->assertFalse($this->service->hasKey());
        $this->assertNull($this->service->getKey());
        $this->assertFalse($this->service->hasBusinessAccount());
        $this->assertNull($this->service->getBusinessAccount());
    }

    public function testInitialState()
    {
        $this->service = $this->getMockBuilder(AbstractParsableService::class)
            ->setConstructorArgs([
                $this->client = $this->createHttpClientMock(),
                $this->messageFactory = $this->createMessageFactoryMock(),
                $this->url = 'http://foo',
                $parser = $this->createParserMock(),
            ])
            ->getMockForAbstractClass();

        $this->assertSame($parser, $this->service->getParser());
    }

    public function testClient()
    {
        $this->service->setClient($client = $this->createHttpClientMock());

        $this->assertSame($client, $this->service->getClient());
    }

    public function testMessageFactory()
    {
        $this->service->setMessageFactory($messageFactory = $this->createMessageFactoryMock());

        $this->assertSame($messageFactory, $this->service->getMessageFactory());
    }

    public function testHttps()
    {
        $this->service->setHttps(true);

        $this->assertTrue($this->service->isHttps());
    }

    public function testUrl()
    {
        $this->assertSame('https://foo', $this->service->getUrl());
    }

    public function testUrlWithHttps()
    {
        $this->service->setHttps(false);

        $this->assertSame('http://foo', $this->service->getUrl());
    }

    public function testFormat()
    {
        $this->service->setFormat($format = AbstractParsableService::FORMAT_XML);

        $this->assertSame($format, $this->service->getFormat());
    }

    public function testParser()
    {
        $this->service->setParser($parser = $this->createParserMock());

        $this->assertSame($parser, $this->service->getParser());
    }

    public function testKey()
    {
        $this->service->setKey($key = 'key');

        $this->assertTrue($this->service->hasKey());
        $this->assertSame($key, $this->service->getKey());
    }

    public function testResetKey()
    {
        $this->service->setKey($key = 'key');
        $this->service->setKey(null);

        $this->assertFalse($this->service->hasKey());
        $this->assertNull($this->service->getKey());
    }

    public function testBusinessAccount()
    {
        $this->service->setBusinessAccount($businessAccount = $this->createBusinessAccountMock());

        $this->assertTrue($this->service->hasBusinessAccount());
        $this->assertSame($businessAccount, $this->service->getBusinessAccount());
    }

    public function testResetBusinessAccount()
    {
        $this->service->setBusinessAccount($this->createBusinessAccountMock());
        $this->service->setBusinessAccount();

        $this->assertFalse($this->service->hasBusinessAccount());
        $this->assertNull($this->service->getBusinessAccount());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClient
     */
    private function createHttpClientMock()
    {
        return $this->createMock(HttpClient::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MessageFactory
     */
    private function createMessageFactoryMock()
    {
        return $this->createMock(MessageFactory::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Parser
     */
    private function createParserMock()
    {
        return $this->createMock(Parser::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BusinessAccount
     */
    private function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }
}
