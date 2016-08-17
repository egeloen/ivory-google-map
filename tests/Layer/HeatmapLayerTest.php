<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Layer;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HeatmapLayer
     */
    private $heatmapLayer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->heatmapLayer = new HeatmapLayer();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->heatmapLayer);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->heatmapLayer);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('heatmap_layer', $this->heatmapLayer->getVariable());
        $this->assertFalse($this->heatmapLayer->hasCoordinates());
        $this->assertEmpty($this->heatmapLayer->getCoordinates());
    }

    public function testInitialState()
    {
        $this->heatmapLayer = new HeatmapLayer(
            $coordinates = [$this->createCoordinateMock()],
            $options = ['foo' => 'bar']
        );

        $this->assertTrue($this->heatmapLayer->hasCoordinates());
        $this->assertSame($coordinates, $this->heatmapLayer->getCoordinates());
        $this->assertTrue($this->heatmapLayer->hasOptions());
        $this->assertSame($options, $this->heatmapLayer->getOptions());
    }

    public function testSetCoordinates()
    {
        $this->heatmapLayer->setCoordinates($coordinates = [$coordinate = $this->createCoordinateMock()]);
        $this->heatmapLayer->setCoordinates($coordinates);

        $this->assertTrue($this->heatmapLayer->hasCoordinates());
        $this->assertTrue($this->heatmapLayer->hasCoordinate($coordinate));
        $this->assertSame($coordinates, $this->heatmapLayer->getCoordinates());
    }

    public function testAddCoordinates()
    {
        $this->heatmapLayer->setCoordinates($firstCoordinates = [$this->createCoordinateMock()]);
        $this->heatmapLayer->addCoordinates($secondCoordinates = [$this->createCoordinateMock()]);

        $this->assertTrue($this->heatmapLayer->hasCoordinates());
        $this->assertSame(array_merge($firstCoordinates, $secondCoordinates), $this->heatmapLayer->getCoordinates());
    }

    public function testAddCoordinate()
    {
        $this->heatmapLayer->addCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertTrue($this->heatmapLayer->hasCoordinates());
        $this->assertTrue($this->heatmapLayer->hasCoordinate($coordinate));
        $this->assertSame([$coordinate], $this->heatmapLayer->getCoordinates());
    }

    public function testRemoveCoordinate()
    {
        $this->heatmapLayer->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->heatmapLayer->removeCoordinate($coordinate);

        $this->assertFalse($this->heatmapLayer->hasCoordinates());
        $this->assertFalse($this->heatmapLayer->hasCoordinate($coordinate));
        $this->assertEmpty($this->heatmapLayer->getCoordinates());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
