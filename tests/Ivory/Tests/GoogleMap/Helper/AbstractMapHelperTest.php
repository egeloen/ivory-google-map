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
 * Abstract map helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractMapHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\AbstractMapHelper */
    protected $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapHelper = $this->getMockForAbstractClass('Ivory\GoogleMap\Helper\AbstractMapHelper');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapHelper);
    }

    public function testJsContainerName()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('foo'));

        $method = new \ReflectionMethod($this->mapHelper, 'getJsContainerName');
        $method->setAccessible(true);

        $this->assertSame('foo_container', $method->invoke($this->mapHelper, $map));
    }
}
