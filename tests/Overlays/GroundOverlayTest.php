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

use Ivory\GoogleMap\Overlays\GroundOverlay;

/**
 * Ground overlay test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayTest extends AbstractExtendableTest
{
    /** @vra \Ivory\GoogleMap\Overlays\GroundOverlay */
    private $groundOverlay;

    /** @var string */
    private $url;

    /** @var \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlay = new GroundOverlay(
            $this->url = 'url',
            $this->bound = $this->createBoundMock('ground_overlay_bound')
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->bound);
        unset($this->url);
        unset($this->groundOverlay);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->groundOverlay);
        $this->assertExtendableInstance($this->groundOverlay);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('ground_overlay_', $this->groundOverlay->getVariable());
        $this->assertSame($this->url, $this->groundOverlay->getUrl());
        $this->assertSame($this->bound, $this->groundOverlay->getBound());
        $this->assertFalse($this->groundOverlay->hasOptions());
    }

    public function testSetUrl()
    {
        $this->groundOverlay->setUrl($url = 'foo');

        $this->assertSame($url, $this->groundOverlay->getUrl());
    }

    public function testSetBound()
    {
        $this->groundOverlay->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->groundOverlay->getBound());
    }

    public function testRenderExtend()
    {
        $this->assertSame(
            'bound.union(ground_overlay_bound)',
            $this->groundOverlay->renderExtend($this->createBoundMock())
        );
    }
}
