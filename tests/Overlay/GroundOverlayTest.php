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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GroundOverlay
     */
    private $groundOverlay;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Bound
     */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlay = new GroundOverlay(
            $this->url = 'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
            $this->bound = $this->createBoundMock()
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->groundOverlay);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->groundOverlay);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->groundOverlay);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('ground_overlay', $this->groundOverlay->getVariable());
        $this->assertSame($this->url, $this->groundOverlay->getUrl());
        $this->assertSame($this->bound, $this->groundOverlay->getBound());
        $this->assertFalse($this->groundOverlay->hasOptions());
    }

    public function testInitialState()
    {
        $this->groundOverlay = new GroundOverlay($this->url, $this->bound, $options = ['foo' => 'bar']);

        $this->assertStringStartsWith('ground_overlay', $this->groundOverlay->getVariable());
        $this->assertSame($this->url, $this->groundOverlay->getUrl());
        $this->assertSame($this->bound, $this->groundOverlay->getBound());
        $this->assertSame($options, $this->groundOverlay->getOptions());
    }

    public function testUrl()
    {
        $this->groundOverlay->setUrl($url = 'foo');

        $this->assertSame($url, $this->groundOverlay->getUrl());
    }

    public function testBound()
    {
        $this->groundOverlay->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->groundOverlay->getBound());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
