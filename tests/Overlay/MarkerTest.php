<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Marker
     */
    private $marker;

    /**
     * @var Coordinate|\PHPUnit_Framework_MockObject_MockObject
     */
    private $position;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->marker = new Marker($this->position = $this->createCoordinateMock());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->marker);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->marker);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->marker);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('marker', $this->marker->getVariable());
        $this->assertSame($this->position, $this->marker->getPosition());
        $this->assertFalse($this->marker->hasAnimation());
        $this->assertNull($this->marker->getAnimation());
        $this->assertFalse($this->marker->hasIcon());
        $this->assertNull($this->marker->getIcon());
        $this->assertFalse($this->marker->hasShape());
        $this->assertNull($this->marker->getShape());
        $this->assertFalse($this->marker->hasInfoWindow());
        $this->assertNull($this->marker->getInfoWindow());
        $this->assertFalse($this->marker->hasOptions());
    }

    public function testInitialState()
    {
        $this->marker = new Marker(
            $position = $this->createCoordinateMock(),
            $animation = Animation::BOUNCE,
            $icon = $this->createIconMock(),
            $shape = $this->createMarkerShapeMock(),
            $options = ['foo' => 'bar']
        );

        $this->assertStringStartsWith('marker', $this->marker->getVariable());
        $this->assertSame($position, $this->marker->getPosition());
        $this->assertTrue($this->marker->hasAnimation());
        $this->assertSame($animation, $this->marker->getAnimation());
        $this->assertTrue($this->marker->hasIcon());
        $this->assertSame($icon, $this->marker->getIcon());
        $this->assertTrue($this->marker->hasShape());
        $this->assertSame($shape, $this->marker->getShape());
        $this->assertFalse($this->marker->hasInfoWindow());
        $this->assertNull($this->marker->getInfoWindow());
        $this->assertSame($options, $this->marker->getOptions());
    }

    public function testPosition()
    {
        $this->marker->setPosition($position = $this->createCoordinateMock());

        $this->assertSame($position, $this->marker->getPosition());
    }

    public function testAnimation()
    {
        $this->marker->setAnimation($animation = Animation::DROP);

        $this->assertTrue($this->marker->hasAnimation());
        $this->assertSame($animation, $this->marker->getAnimation());
    }

    public function testResetAnimation()
    {
        $this->marker->setAnimation(Animation::DROP);
        $this->marker->setAnimation(null);

        $this->assertFalse($this->marker->hasAnimation());
        $this->assertNull($this->marker->getAnimation());
    }

    public function testIcon()
    {
        $this->marker->setIcon($icon = $this->createIconMock());

        $this->assertTrue($this->marker->hasIcon());
        $this->assertSame($icon, $this->marker->getIcon());
    }

    public function testResetIcon()
    {
        $this->marker->setIcon($this->createIconMock());
        $this->marker->setIcon(null);

        $this->assertFalse($this->marker->hasIcon());
        $this->assertNull($this->marker->getIcon());
    }

    public function testShape()
    {
        $this->marker->setShape($shape = $this->createMarkerShapeMock());

        $this->assertTrue($this->marker->hasShape());
        $this->assertSame($shape, $this->marker->getShape());
    }

    public function testResetShape()
    {
        $this->marker->setShape($this->createMarkerShapeMock());
        $this->marker->setShape(null);

        $this->assertFalse($this->marker->hasShape());
        $this->assertNull($this->marker->getShape());
    }

    public function testInfoWindow()
    {
        $this->marker->setInfoWindow($infoWindow = $this->createInfoWindowMock());

        $this->assertTrue($this->marker->hasInfoWindow());
        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }

    public function testResetInfoWindow()
    {
        $this->marker->setInfoWindow($this->createInfoWindowMock());
        $this->marker->setInfoWindow(null);

        $this->assertFalse($this->marker->hasInfoWindow());
        $this->assertNull($this->marker->getInfoWindow());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Icon
     */
    private function createIconMock()
    {
        return $this->createMock(Icon::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerShape
     */
    private function createMarkerShapeMock()
    {
        return $this->createMock(MarkerShape::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|InfoWindow
     */
    private function createInfoWindowMock()
    {
        return $this->createMock(InfoWindow::class);
    }
}
