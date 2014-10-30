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

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\InfoWindowType;

/**
 * Info window test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\InfoWindow */
    private $infoWindow;

    /** @var string */
    private $content;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindow = new InfoWindow($this->content = 'content');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->content);
        unset($this->infoWindow);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->infoWindow);
        $this->assertExtendableInstance($this->infoWindow);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('info_window_', $this->infoWindow->getVariable());
        $this->assertSame($this->content, $this->infoWindow->getContent());
        $this->assertNoPosition();
        $this->assertNoPixelOffset();
        $this->assertFalse($this->infoWindow->isOpen());
        $this->assertSame(MouseEvent::CLICK, $this->infoWindow->getOpenEvent());
        $this->assertTrue($this->infoWindow->isAutoOpen());
        $this->assertTrue($this->infoWindow->isAutoClose());
        $this->assertSame(InfoWindowType::DEFAULT_, $this->infoWindow->getType());
        $this->assertFalse($this->infoWindow->hasOptions());
    }

    public function testSetContent()
    {
        $this->infoWindow->setContent($content = 'foo');

        $this->assertSame($content, $this->infoWindow->getContent());
    }

    public function testSetPosition()
    {
        $this->infoWindow->setPosition($position = $this->createCoordinateMock());

        $this->assertPosition($position);
    }

    public function testResetPosition()
    {
        $this->infoWindow->setPosition($this->createCoordinateMock());
        $this->infoWindow->setPosition(null);

        $this->assertNoPosition();
    }

    public function testSetPixedOffset()
    {
        $this->infoWindow->setPixelOffset($pixelOffset = $this->createSizeMock());

        $this->assertPixelOffset($pixelOffset);
    }

    public function testResetPixelOffset()
    {
        $this->infoWindow->setPixelOffset($this->createSizeMock());
        $this->infoWindow->setPixelOffset(null);

        $this->assertNoPixelOffset();
    }

    public function testSetOpen()
    {
        $this->infoWindow->setOpen(true);

        $this->assertTrue($this->infoWindow->isOpen());
    }

    public function testSetOpenEvent()
    {
        $this->infoWindow->setOpenEvent($openEvent = MouseEvent::DBLCLICK);

        $this->assertSame($openEvent, $this->infoWindow->getOpenEvent());
    }

    public function testSetAutoOpen()
    {
        $this->infoWindow->setAutoOpen(true);

        $this->assertTrue($this->infoWindow->isAutoOpen());
    }

    public function testSetAutoClose()
    {
        $this->infoWindow->setAutoClose(true);

        $this->assertTrue($this->infoWindow->isAutoClose());
    }

    public function testSetType()
    {
        $this->infoWindow->setType($type = InfoWindowType::INFOBOX);

        $this->assertSame($type, $this->infoWindow->getType());
    }

    public function testRenderExtend()
    {
        $this->infoWindow->setVariable('info_window');

        $this->assertSame(
            'bound.extend(info_window.getPosition())',
            $this->infoWindow->renderExtend($this->createBoundMock())
        );
    }

    /**
     * Asserts there is a position.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $position The position.
     */
    private function assertPosition($position)
    {
        $this->assertCoordinateInstance($position);

        $this->assertTrue($this->infoWindow->hasPosition());
        $this->assertSame($position, $this->infoWindow->getPosition());
    }

    /**
     * Asserts there is a pixel offset.
     *
     * @param \Ivory\GoogleMap\Base\Size $pixelOffset The pixel offset.
     */
    private function assertPixelOffset($pixelOffset)
    {
        $this->assertSizeInstance($pixelOffset);

        $this->assertTrue($this->infoWindow->hasPixelOffset());
        $this->assertSame($pixelOffset, $this->infoWindow->getPixelOffset());
    }

    /**
     * Asserts there is no position.
     */
    private function assertNoPosition()
    {
        $this->assertFalse($this->infoWindow->hasPosition());
        $this->assertNull($this->infoWindow->getPosition());
    }

    /**
     * Asserts there is no pixel offset.
     */
    private function assertNoPixelOffset()
    {
        $this->assertFalse($this->infoWindow->hasPixelOffset());
        $this->assertNull($this->infoWindow->getPixelOffset());
    }
}
