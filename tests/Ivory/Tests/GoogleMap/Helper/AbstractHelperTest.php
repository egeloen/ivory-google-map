<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper;

/**
 * Abstract helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\AbstractHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = $this->getMockForAbstractClass('Ivory\GoogleMap\Helper\AbstractHelper');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->helper);
    }

    public function testInitialState()
    {
        $this->assertInstanceOf('Ivory\JsonBuilder\JsonBuilder', $this->helper->getJsonBuilder());
    }

    public function testJsContainerName()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('foo'));

        $method = new \ReflectionMethod($this->helper, 'getJsContainerName');
        $method->setAccessible(true);

        $this->assertSame('foo_container', $method->invoke($this->helper, $map));
    }
}
