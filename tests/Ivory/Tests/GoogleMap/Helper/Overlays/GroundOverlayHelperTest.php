<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper;

/**
 * Ground overlay helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper */
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

        $this->assertSame(
            'groundOverlay = new google.maps.GroundOverlay("url", bound, {"map":map});'.PHP_EOL,
            $this->groundOverlayHelper->render($groundOverlay, $map)
        );
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
        $groundOverlay->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = <<<EOF
groundOverlay = new google.maps.GroundOverlay("url", bound, {"map":map,"option1":"value1","option2":"value2"});

EOF;

        $this->assertSame($expected, $this->groundOverlayHelper->render($groundOverlay, $map));
    }
}
