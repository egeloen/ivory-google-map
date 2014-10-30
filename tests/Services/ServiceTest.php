<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services;

use Ivory\GoogleMap\Services\AbstractService;

/**
 * Service test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ServiceTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\AbstractService */
    private $service;

    /** @var \Ivory\HttpAdapter\HttpAdapterInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $httpAdapter;

    /** @var string */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->service = $this->createServiceMockBuilder()
            ->setConstructorArgs(array($this->httpAdapter = $this->createHttpAdapterMock(), $this->url = 'http://foo'))
            ->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->url);
        unset($this->httpAdapter);
        unset($this->service);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->httpAdapter, $this->service->getHttpAdapter());
        $this->assertSame($this->url, $this->service->getUrl());
        $this->assertFalse($this->service->isHttps());
        $this->assertSame(AbstractService::FORMAT_JSON, $this->service->getFormat());
        $this->assertXmlParserInstance($this->service->getXmlParser());
        $this->assertFalse($this->service->hasBusinessAccount());
        $this->assertNull($this->service->getBusinessAccount());
    }

    public function testInitialState()
    {
        $this->service = $this->createServiceMockBuilder()
            ->setConstructorArgs(array(
                $this->httpAdapter = $this->createHttpAdapterMock(),
                $this->url,
                true,
                $format = AbstractService::FORMAT_XML,
                $xmlParser = $this->createXmlParserMock(),
                $businessAccount = $this->createBusinessAccountMock(),
            ))
            ->getMockForAbstractClass();

        $this->assertTrue($this->service->isHttps());
        $this->assertSame($format, $this->service->getFormat());
        $this->assertSame($xmlParser, $this->service->getXmlParser());
        $this->assertTrue($this->service->hasBusinessAccount());
        $this->assertSame($businessAccount, $this->service->getBusinessAccount());
    }

    public function testSetHttpAdapter()
    {
        $this->service->setHttpAdapter($httpAdapter = $this->createHttpAdapterMock());

        $this->assertSame($httpAdapter, $this->service->getHttpAdapter());
    }

    public function testSetHttps()
    {
        $this->service->setHttps(true);

        $this->assertTrue($this->service->isHttps());
        $this->assertSame('https://foo', $this->service->getUrl());
    }

    public function testSetFormat()
    {
        $this->service->setFormat($format = AbstractService::FORMAT_XML);

        $this->assertSame($format, $this->service->getFormat());
    }

    public function testSetXmlParser()
    {
        $this->service->setXmlParser($xmlParser = $this->createXmlParserMock());

        $this->assertSame($xmlParser, $this->service->getXmlParser());
    }

    public function testSetBusinessAccount()
    {
        $this->service->setBusinessAccount($businessAccount = $this->createBusinessAccountMock());

        $this->assertTrue($this->service->hasBusinessAccount());
        $this->assertSame($businessAccount, $this->service->getBusinessAccount());
    }

    public function testResetBusinessAccount()
    {
        $this->service->setBusinessAccount($this->createBusinessAccountMock());
        $this->service->setBusinessAccount(null);

        $this->assertFalse($this->service->hasBusinessAccount());
        $this->assertNull($this->service->getBusinessAccount());
    }

    public function testSignUrlWithoutBusinessAccount()
    {
        $method = new \ReflectionMethod($this->service, 'signUrl');
        $method->setAccessible(true);

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $this->assertSame($url, $method->invoke($this->service, $url));
    }

    public function testSignUrlWithBusinessAccount()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo($url))
            ->will($this->returnValue($signedUrl = 'url'));

        $this->service->setBusinessAccount($businessAccount);

        $method = new \ReflectionMethod($this->service, 'signUrl');
        $method->setAccessible(true);

        $this->assertSame($signedUrl, $method->invoke($this->service, $url));
    }

    /**
     * {@inheritdoc}
     */
    protected function createHttpAdapterMock()
    {
        $httpAdapter = parent::createHttpAdapterMock();

        $eventDispatcher = $this->createSymfonyEventDispatcherMock();
        $eventDispatcher
            ->expects($this->once())
            ->method('addSubscriber')
            ->with($this->isInstanceOf('Ivory\HttpAdapter\Event\Subscriber\StatusCodeSubscriber'));

        $configuration = $this->createHttpAdapterConfigurationMock();
        $configuration
            ->expects($this->any())
            ->method('getEventDispatcher')
            ->will($this->returnValue($eventDispatcher));

        $httpAdapter
            ->expects($this->any())
            ->method('getConfiguration')
            ->will($this->returnValue($configuration));

        return $httpAdapter;
    }
}
