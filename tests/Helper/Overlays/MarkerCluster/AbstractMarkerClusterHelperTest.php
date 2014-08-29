<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays\MarkerCluster;

/**
 * Abstract marker cluster helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractMarkerClusterHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = $this->getMockForAbstractClass('Ivory\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->helper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helper\Overlays\MarkerHelper', $this->helper->getMarkerHelper());
    }

    public function testInitialState()
    {
        $markerHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\MarkerHelper');

        $this->helper = $this->getMockBuilder('Ivory\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper')
            ->setConstructorArgs(array($markerHelper))
            ->getMockForAbstractClass();

        $this->assertSame($markerHelper, $this->helper->getMarkerHelper());
    }
}
