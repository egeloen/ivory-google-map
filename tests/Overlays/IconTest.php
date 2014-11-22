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

use Ivory\GoogleMap\Overlays\Icon;

/**
 * Icon test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Icon */
    private $icon;

    /** @var string */
    private $url;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->icon = new Icon($this->url = 'url');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->url);
        unset($this->icon);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->icon);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('icon_', $this->icon->getVariable());
        $this->assertSame($this->url, $this->icon->getUrl());
        $this->assertNoAnchor();
        $this->assertNoOrigin();
        $this->assertNoScaledSize();
        $this->assertNoSize();
    }

    public function testSetUrl()
    {
        $this->icon->setUrl($url = 'foo');

        $this->assertSame($url, $this->icon->getUrl());
    }

    public function testSetAnchor()
    {
        $this->icon->setAnchor($point = $this->createPointMock());

        $this->assertSame($point, $this->icon->getAnchor());
    }

    public function testResetAnchor()
    {
        $this->icon->setAnchor($this->createPointMock());
        $this->icon->setAnchor(null);

        $this->assertNoAnchor();
    }

    public function testSetOrigin()
    {
        $this->icon->setOrigin($point = $this->createPointMock());

        $this->assertSame($point, $this->icon->getOrigin());
    }

    public function testResetOrigin()
    {
        $this->icon->setOrigin($this->createPointMock());
        $this->icon->setOrigin(null);

        $this->assertNoOrigin();
    }

    public function testSetScaledSize()
    {
        $this->icon->setScaledSize($size = $this->createSizeMock());

        $this->assertSame($size, $this->icon->getScaledSize());
    }

    public function testResetScaledSize()
    {
        $this->icon->setScaledSize($this->createSizeMock());
        $this->icon->setScaledSize(null);

        $this->assertNoScaledSize();
    }

    public function testSetSize()
    {
        $this->icon->setSize($size = $this->createSizeMock());

        $this->assertSame($size, $this->icon->getSize());
    }

    public function testResetSize()
    {
        $this->icon->setSize($this->createSizeMock());
        $this->icon->setSize(null);

        $this->assertNoSize();
    }

    /**
     * Asserts there is an anchor.
     *
     * @param \Ivory\GoogleMap\Base\Point $anchor The anchor.
     */
    private function assertAnchor($anchor)
    {
        $this->assertPointInstance($anchor);

        $this->assertTrue($this->icon->hasAnchor());
        $this->assertSame($anchor, $this->icon->getAnchor());
    }

    /**
     * Asserts there is an origin.
     *
     * @param \Ivory\GoogleMap\Base\Point $origin The origin.
     */
    private function assertOrigin($origin)
    {
        $this->assertPointInstance($origin);

        $this->assertTrue($this->icon->hasOrigin());
        $this->assertSame($origin, $this->icon->getOrigin());
    }

    /**
     * Asserts there is a scaled size.
     *
     * @param \Ivory\GoogleMap\Base\Size $scaledSize The scaled size.
     */
    private function assertScaledSize($scaledSize)
    {
        $this->assertSizeInstance($scaledSize);

        $this->assertTrue($this->icon->hasScaledSize());
        $this->assertSame($scaledSize, $this->icon->getScaledSize());
    }

    /**
     * Asserts there is a size.
     *
     * @param \Ivory\GoogleMap\Base\Size $size The size.
     */
    private function assertSize($size)
    {
        $this->assertSizeInstance($size);

        $this->assertTrue($this->icon->hasSize());
        $this->assertSame($size, $this->icon->getSize());
    }

    /**
     * Asserts there is no anchor.
     */
    private function assertNoAnchor()
    {
        $this->assertFalse($this->icon->hasAnchor());
        $this->assertNull($this->icon->getAnchor());
    }

    /**
     * Asserts there is no origin.
     */
    private function assertNoOrigin()
    {
        $this->assertFalse($this->icon->hasOrigin());
        $this->assertNull($this->icon->getOrigin());
    }

    /**
     * Asserts there is no scaled size.
     */
    private function assertNoScaledSize()
    {
        $this->assertFalse($this->icon->hasScaledSize());
        $this->assertNull($this->icon->getScaledSize());
    }

    /**
     * Asserts there is no size.
     */
    private function assertNoSize()
    {
        $this->assertFalse($this->icon->hasSize());
        $this->assertNull($this->icon->getSize());
    }
}
