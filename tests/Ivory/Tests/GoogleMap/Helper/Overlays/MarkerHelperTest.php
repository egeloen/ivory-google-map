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

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Helper\Overlays\MarkerHelper;

/**
 * Marker helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerHelper */
    protected $markerHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerHelper = new MarkerHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\AnimationHelper',
            $this->markerHelper->getAnimationHelper()
        );
    }

    public function testInitialState()
    {
        $animationHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\AnimationHelper');

        $this->markerHelper = new MarkerHelper($animationHelper);

        $this->assertSame($animationHelper, $this->markerHelper->getAnimationHelper());
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');

        $marker->setAnimation(Animation::BOUNCE);

        $marker->setPosition(1.1, 2.1, true);
        $marker->getPosition()->setJavascriptVariable('position');

        $marker->setIcon('url');
        $marker->getIcon()->setJavascriptVariable('icon');

        $marker->setShadow('url');
        $marker->getShadow()->setJavascriptVariable('shadow');

        $marker->setShape('poly', array(1, 2, 3, 4));
        $marker->getShape()->setJavascriptVariable('shape');

        $expected = 'marker = new google.maps.Marker({'.
            '"map":map,'.
            '"position":position, '.
            '"animation":google.maps.Animation.BOUNCE, '.
            '"icon":icon, '.
            '"shadow":shadow, '.
            '"shape":shape'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->markerHelper->render($marker, $map));
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->any())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');

        $marker->setAnimation(Animation::BOUNCE);

        $marker->setPosition(1.1, 2.1, true);
        $marker->getPosition()->setJavascriptVariable('position');

        $marker->setIcon('url');
        $marker->getIcon()->setJavascriptVariable('icon');

        $marker->setShadow('url');
        $marker->getShadow()->setJavascriptVariable('shadow');

        $marker->setShape('poly', array(1, 2, 3, 4));
        $marker->getShape()->setJavascriptVariable('shape');

        $marker->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = 'marker = new google.maps.Marker({'.
            '"map":map,'.
            '"position":position, '.
            '"animation":google.maps.Animation.BOUNCE, '.
            '"icon":icon, '.
            '"shadow":shadow, '.
            '"shape":shape,'.
            '"option1":"value1",'.
            '"option2":"value2"'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->markerHelper->render($marker, $map));
    }
}
