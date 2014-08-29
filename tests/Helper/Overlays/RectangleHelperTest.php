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
use Ivory\GoogleMap\Overlays\Rectangle;
use Ivory\GoogleMap\Helper\Overlays\RectangleHelper;

/**
 * Rectangle helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\RectangleHelper */
    protected $rectangleHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangleHelper = new RectangleHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangleHelper);
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $bound = new Bound();
        $bound->setJavascriptVariable('rectangleBound');
        $bound->setSouthWest(-1.1, -2.1);
        $bound->setNorthEast(1.1, 2.1);

        $rectangle = new Rectangle($bound);
        $rectangle->setJavascriptVariable('rectangle');

        $this->assertSame(
            'rectangle = new google.maps.Rectangle({"map":map,"bounds":rectangleBound});'.PHP_EOL,
            $this->rectangleHelper->render($rectangle, $map)
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
        $bound->setJavascriptVariable('rectangleBound');
        $bound->setSouthWest(-1.1, -2.1);
        $bound->setNorthEast(1.1, 2.1);

        $rectangle = new Rectangle($bound);
        $rectangle->setJavascriptVariable('rectangle');
        $rectangle->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = <<<EOF
rectangle = new google.maps.Rectangle({"map":map,"bounds":rectangleBound,"option1":"value1","option2":"value2"});

EOF;

        $this->assertSame($expected, $this->rectangleHelper->render($rectangle, $map));
    }
}
