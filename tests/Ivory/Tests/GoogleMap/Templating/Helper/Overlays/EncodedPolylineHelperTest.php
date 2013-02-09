<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Overlays\EncodedPolyline,
    Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper;

/**
 * Encoded polyline helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper */
    protected $encodedPolylineHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineHelper = new EncodedPolylineHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodedPolylineHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Geometry\EncodingHelper',
            $this->encodedPolylineHelper->getEncodingHelper()
        );
    }

    public function testInitialState()
    {
        $encodingHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Geometry\EncodingHelper');

        $this->encodedPolylineHelper = new EncodedPolylineHelper($encodingHelper);

        $this->assertSame($encodingHelper, $this->encodedPolylineHelper->getEncodingHelper());
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setJavascriptVariable('encodedPolyline');

        $this->assertSame(
            'var encodedPolyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo")});'.PHP_EOL,
            $this->encodedPolylineHelper->render($encodedPolyline, $map)
        );
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setJavascriptVariable('encodedPolyline');
        $encodedPolyline->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame(
            'var encodedPolyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo"),"option1":"value1","option2":"value2"});'.PHP_EOL,
            $this->encodedPolylineHelper->render($encodedPolyline, $map)
        );
    }
}
