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

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Services test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a service instance.
     *
     * @param \Ivory\GoogleMap\Services\AbstractService $service The service.
     */
    protected function assertServiceInstance($service)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\AbstractService', $service);
    }

    /**
     * Asserts an xml parser instance.
     *
     * @param \Ivory\GoogleMap\Services\XmlParser $xmlParser The xml parser.
     */
    protected function assertXmlParserInstance($xmlParser)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\XmlParser', $xmlParser);
    }

    /**
     * Creates a business account mock.
     *
     * @return \Ivory\GoogleMap\Services\BusinessAccount|\PHPUnit_Framework_MockObject_MockObject The business account mock.
     */
    protected function createBusinessAccountMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\BusinessAccount')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a distance mock.
     *
     * @return \Ivory\GoogleMap\Services\Base\Distance|\PHPUnit_Framework_MockObject_MockObject The distance mock.
     */
    protected function createDistanceMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Distance')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a duration mock.
     *
     * @return \Ivory\GoogleMap\Services\Base\Duration|\PHPUnit_Framework_MockObject_MockObject The duration mock.
     */
    protected function createDurationMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Duration')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an http adapter mock.
     *
     * @return \Ivory\HttpAdapter\HttpAdapterInterface|\PHPUnit_Framework_MockObject_MockObject The http adapter mock.
     */
    protected function createHttpAdapterMock()
    {
        return $this->getMock('Ivory\HttpAdapter\HttpAdapterInterface');
    }

    /**
     * Creates an http adapter configuration mock.
     *
     * @return \Ivory\HttpAdapter\ConfigurationInterface|\PHPUnit_Framework_MockObject_MockObject The http adapter configuration mock.
     */
    protected function createHttpAdapterConfigurationMock()
    {
        return $this->getMock('Ivory\HttpAdapter\ConfigurationInterface');
    }

    /**
     * Creates a service mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The service mock builder.
     */
    protected function createServiceMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\AbstractService');
    }

    /**
     * Creates an xml parser mock.
     *
     * @return \Ivory\GoogleMap\Services\XmlParser|\PHPUnit_Framework_MockObject_MockBuilder The xml parser mock.
     */
    protected function createXmlParserMock()
    {
        return $this->getMock('Ivory\GoogleMap\Services\XmlParser');
    }
}
