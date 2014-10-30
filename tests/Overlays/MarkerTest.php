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

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\Marker */
    private $marker;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $position;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->marker = new Marker($this->position = $this->createCoordinateMock());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->position);
        unset($this->marker);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->marker);
        $this->assertExtendableInstance($this->marker);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('marker_', $this->marker->getVariable());
        $this->assertSame($this->position, $this->marker->getPosition());
        $this->assertNoAnimation();
        $this->assertNoIcon();
        $this->assertNoShadow();
        $this->assertNoShape();
        $this->assertNoInfoWindow();
        $this->assertFalse($this->marker->hasOptions());
    }

    public function testSetPosition()
    {
        $this->marker->setPosition($position = $this->createCoordinateMock());

        $this->assertSame($position, $this->marker->getPosition());
    }

    public function testSetAnimation()
    {
        $this->marker->setAnimation($animation = Animation::BOUNCE);

        $this->assertAnimation($animation);
    }

    public function testResetAnimation()
    {
        $this->marker->setAnimation(Animation::BOUNCE);
        $this->marker->setAnimation(null);

        $this->assertNoAnimation();
    }

    public function testSetIcon()
    {
        $this->marker->setIcon($icon = $this->createIconMock());

        $this->assertSame($icon, $this->marker->getIcon());
    }

    public function testResetIcon()
    {
        $this->marker->setIcon($this->createIconMock());
        $this->marker->setIcon(null);

        $this->assertNoIcon();
    }

    public function testSetShadow()
    {
        $this->marker->setShadow($shadow = $this->createIconMock());

        $this->assertShadow($shadow);
    }

    public function testResetShadow()
    {
        $this->marker->setShadow($this->createIconMock());
        $this->marker->setShadow(null);

        $this->assertNoShadow();
    }

    public function testSetShape()
    {
        $this->marker->setShape($shape = $this->createMarkerShapeMock());

        $this->assertShape($shape);
    }

    public function testResetShape()
    {
        $this->marker->setShape($this->createMarkerShapeMock());
        $this->marker->setShape(null);

        $this->assertNoShape();
    }

    public function testSetInfoWindow()
    {
        $this->marker->setInfoWindow($infoWindow = $this->createInfoWindowMock());

        $this->assertInfoWindow($infoWindow);
    }

    public function testResetInfoWindow()
    {
        $this->marker->setInfoWindow($this->createInfoWindowMock());
        $this->marker->setInfoWindow(null);

        $this->assertNoInfoWindow();
    }

    public function testRenderExtend()
    {
        $this->marker->setVariable('marker');

        $this->assertSame(
            'bound.extend(marker.getPosition())',
            $this->marker->renderExtend($this->createBoundMock())
        );
    }

    /**
     * Asserts there is an animation.
     *
     * @param string $animation The animation.
     */
    private function assertAnimation($animation)
    {
        $this->assertTrue($this->marker->hasAnimation());
        $this->assertSame($animation, $this->marker->getAnimation());
    }

    /**
     * Asserts there is an icon.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon $icon The icon.
     */
    private function assertIcon($icon)
    {
        $this->assertIconInstance($icon);

        $this->assertTrue($this->marker->hasIcon());
        $this->assertSame($icon, $this->marker->getIcon());
    }

    /**
     * Asserts there is a shadow.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon $shadow The shadow.
     */
    private function assertShadow($shadow)
    {
        $this->assertIconInstance($shadow);

        $this->assertTrue($this->marker->hasShadow());
        $this->assertSame($shadow, $this->marker->getShadow());
    }

    /**
     * Asserts there is a shape.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $shape The shape.
     */
    private function assertShape($shape)
    {
        $this->assertMarkerShapeInstance($shape);

        $this->assertTrue($this->marker->hasShape());
        $this->assertSame($shape, $this->marker->getShape());
    }

    /**
     * Asserts there is an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    private function assertInfoWindow($infoWindow)
    {
        $this->assertInfoWindowInstance($infoWindow);

        $this->assertTrue($this->marker->hasInfoWindow());
        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }

    /**
     * Asserts there is no animation.
     */
    private function assertNoAnimation()
    {
        $this->assertFalse($this->marker->hasAnimation());
        $this->assertNull($this->marker->getAnimation());
    }

    /**
     * Asserts there is no icon.
     */
    private function assertNoIcon()
    {
        $this->assertFalse($this->marker->hasIcon());
        $this->assertNull($this->marker->getIcon());
    }

    /**
     * Asserts there is no shadow.
     */
    private function assertNoShadow()
    {
        $this->assertFalse($this->marker->hasShadow());
        $this->assertNull($this->marker->getShadow());
    }

    /**
     * Asserts there is no shape.
     */
    private function assertNoShape()
    {
        $this->assertFalse($this->marker->hasShape());
        $this->assertNull($this->marker->getShape());
    }

    /**
     * Asserts there is no info window.
     */
    private function assertNoInfoWindow()
    {
        $this->assertFalse($this->marker->hasInfoWindow());
        $this->assertNull($this->marker->getInfoWindow());
    }
}
