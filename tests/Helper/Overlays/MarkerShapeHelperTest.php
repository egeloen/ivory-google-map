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

use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper;

/**
 * Marker shape helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper */
    protected $markerShapeHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShapeHelper = new MarkerShapeHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerShapeHelper);
    }

    public function testRenderWithPolyType()
    {
        $markerShape = new MarkerShape('poly', array(1, 2, 3, 4, 5, 6));
        $markerShape->setJavascriptVariable('markerShape');

        $this->assertSame(
            'markerShape = new google.maps.MarkerShape({"type":"poly","coords":[1,2,3,4,5,6]});'.PHP_EOL,
            $this->markerShapeHelper->render($markerShape)
        );
    }

    public function testRenderWithCircleType()
    {
        $markerShape = new MarkerShape('circle', array(1, 2, 3));
        $markerShape->setJavascriptVariable('markerShape');

        $this->assertSame(
            'markerShape = new google.maps.MarkerShape({"type":"circle","coords":[1,2,3]});'.PHP_EOL,
            $this->markerShapeHelper->render($markerShape)
        );
    }

    public function testRenderWithRectangleType()
    {
        $markerShape = new MarkerShape('rect', array(-1, -1, 1, 1));
        $markerShape->setJavascriptVariable('markerShape');

        $this->assertSame(
            'markerShape = new google.maps.MarkerShape({"type":"rect","coords":[-1,-1,1,1]});'.PHP_EOL,
            $this->markerShapeHelper->render($markerShape)
        );
    }
}
