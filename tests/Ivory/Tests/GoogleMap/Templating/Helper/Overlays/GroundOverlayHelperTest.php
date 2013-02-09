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

use Ivory\GoogleMap\Base\Bound,
    Ivory\GoogleMap\Overlays\GroundOverlay,
    Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper;

/**
 * Ground overlay helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper */
    protected $groundOverlayHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlayHelper = new GroundOverlayHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlayHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\BoundHelper',
            $this->groundOverlayHelper->getBoundHelper()
        );
    }

    public function testInitialState()
    {
        $boundHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\BoundHelper');

        $this->groundOverlayHelper->setBoundHelper($boundHelper);

        $this->assertSame($boundHelper, $this->groundOverlayHelper->getBoundHelper());
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $bound = new Bound();
        $bound->setJavascriptVariable('bound');
        $bound->setSouthWest(-1.1, -2.1, true);
        $bound->setNorthEast(1.1, 2.1, true);

        $groundOverlay = new GroundOverlay('url', $bound);
        $groundOverlay->setJavascriptVariable('groundOverlay');

        $expected = <<<EOF
var bound = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));
var groundOverlay = new google.maps.GroundOverlay("url", bound, {"map":map});

EOF;

        $this->assertSame($expected, $this->groundOverlayHelper->render($groundOverlay, $map));
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $bound = new Bound();
        $bound->setJavascriptVariable('bound');
        $bound->setSouthWest(-1.1, -2.1, true);
        $bound->setNorthEast(1.1, 2.1, true);

        $groundOverlay = new GroundOverlay('url', $bound);
        $groundOverlay->setJavascriptVariable('groundOverlay');
        $groundOverlay->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $expected = <<<EOF
var bound = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));
var groundOverlay = new google.maps.GroundOverlay("url", bound, {"map":map,"option1":"value1","option2":"value2"});

EOF;

        $this->assertSame($expected, $this->groundOverlayHelper->render($groundOverlay, $map));
    }
}
