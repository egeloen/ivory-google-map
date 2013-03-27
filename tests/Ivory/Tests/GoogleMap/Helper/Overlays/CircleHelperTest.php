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

use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Helper\Overlays\CircleHelper;

/**
 * Circle helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\CircleHelper */
    protected $circleHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circleHelper = new CircleHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circleHelper);
    }

    public function testRender()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $circle = new Circle();
        $circle->setJavascriptVariable('circle');

        $circle->setCenter(1.1, 2.1, true);
        $circle->getCenter()->setJavascriptVariable('center');

        $circle->setRadius(2);
        $circle->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = 'circle = new google.maps.Circle({'.
            '"map":map,'.
            '"center":center,'.
            '"radius":2,'.
            '"option1":"value1",'.
            '"option2":"value2"'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->circleHelper->render($circle, $map));
    }
}
