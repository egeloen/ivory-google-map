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

/**
 * Abstract service test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\AbstractService */
    protected $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->service = $this->getMockBuilder('Ivory\GoogleMap\Services\AbstractService')
            ->setConstructorArgs(array('http://foo'))
            ->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->service);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Buzz\Browser', $this->service->getBrowser());
        $this->assertSame('http://foo', $this->service->getUrl());
        $this->assertFalse($this->service->isHttps());
        $this->assertSame('json', $this->service->getFormat());
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Utils\XmlParser', $this->service->getXmlParser());
    }

    public function testInitialState()
    {
        $browser = $this->getMock('Buzz\Browser');
        $xmlParser = $this->getMock('Ivory\GoogleMap\Services\Utils\XmlParser');

        $this->service = $this->getMockBuilder('Ivory\GoogleMap\Services\AbstractService')
            ->setConstructorArgs(array('http://bar', true, 'xml', $browser, $xmlParser))
            ->getMockForAbstractClass();

        $this->assertSame($browser, $this->service->getBrowser());
        $this->assertSame('https://bar', $this->service->getUrl());
        $this->assertTrue($this->service->isHttps());
        $this->assertSame('xml', $this->service->getFormat());
        $this->assertSame($xmlParser, $this->service->getXmlParser());
    }

    public function testHttps()
    {
        $this->service->setHttps(true);

        $this->assertTrue($this->service->isHttps());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The service https flag must be a boolean value.
     */
    public function testHttpsWithInvalidValue()
    {
        $this->service->setHttps('foo');
    }

    public function testUrlWithHttps()
    {
        $this->service->setHttps(true);
        $this->assertSame('https://foo', $this->service->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The service url must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->service->setUrl(true);
    }

    public function testFormatWithJsonAndXml()
    {
        $this->service->setFormat('xml');
        $this->assertSame('xml', $this->service->getFormat());

        $this->service->setFormat('json');
        $this->assertSame('json', $this->service->getFormat());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The service format can only be : json, xml.
     */
    public function testFormatWithInvalidValue()
    {
        $this->service->setFormat('foo');
    }

    public function testXmlParser()
    {
        $xmlParser = $this->getMock('Ivory\GoogleMap\Services\Utils\XmlParser');
        $this->service->setXmlParser($xmlParser);

        $this->assertSame($xmlParser, $this->service->getXmlParser());
    }
}
