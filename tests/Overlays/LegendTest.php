<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Legend;

/**
 * Legend test.
 *
 * @author Elie CHARRA <elie.charra@gmail.com>
 */
class LegendTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Legend */
    protected $legend;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->legend = new Legend();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->legend);
    }

    public function testConstructor()
    {
        $this->legend = new Legend('testName', array('color' => 'red'));

        $this->assertSame("testName", $this->legend->getName());
        $this->assertSame(array('color' => 'red'), $this->legend->getStyles());
    }

    public function testInitialState()
    {
        $this->legend = new Legend();

        $this->assertSame("map_legend", $this->legend->getName());
        $this->assertSame(array(), $this->legend->getStyles());
    }

    public function testLegendWithName()
    {
        $this->legend = new Legend();
        $this->legend->setName('myLegend');

        $this->assertSame('myLegend', $this->legend->getName());
    }

    public function testLegendWithStyles()
    {
        $this->legend = new Legend();
        $styles = array('color' => 'red');
        $this->legend->setStyles($styles);

        $this->assertSame($styles, $this->legend->getStyles());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage Legend styles must be an array of styles. ex : array("color" => "red").
     */
    public function testLegendWithInvalidStyles()
    {
        $styles = 'test';

        $this->legend->setStyles($styles);
    }
}
