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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolTest extends TestCase
{
    /**
     * @var Symbol
     */
    private $symbol;

    /**
     * @var string
     */
    private $path;

    protected function setUp(): void
    {
        $this->symbol = new Symbol($this->path = SymbolPath::CIRCLE);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->symbol);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->symbol);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('symbol', $this->symbol->getVariable());
        $this->assertSame($this->path, $this->symbol->getPath());
        $this->assertFalse($this->symbol->hasAnchor());
        $this->assertNull($this->symbol->getAnchor());
        $this->assertFalse($this->symbol->hasLabelOrigin());
        $this->assertNull($this->symbol->getLabelOrigin());
        $this->assertFalse($this->symbol->hasOptions());
    }

    public function testInitialState()
    {
        $this->symbol = new Symbol(
            $this->path,
            $anchor = $this->createPointMock(),
            $labelOrigin = $this->createPointMock(),
            $options = ['foo' => 'bar']
        );

        $this->assertTrue($this->symbol->hasAnchor());
        $this->assertSame($anchor, $this->symbol->getAnchor());
        $this->assertTrue($this->symbol->hasLabelOrigin());
        $this->assertSame($labelOrigin, $this->symbol->getLabelOrigin());
        $this->assertSame($options, $this->symbol->getOptions());
    }

    public function testPath()
    {
        $this->symbol->setPath($path = SymbolPath::BACKWARD_CLOSED_ARROW);

        $this->assertSame($path, $this->symbol->getPath());
    }

    public function testAnchor()
    {
        $this->symbol->setAnchor($anchor = $this->createPointMock());

        $this->assertSame($anchor, $this->symbol->getAnchor());
    }

    public function testResetAnchor()
    {
        $this->symbol->setAnchor($this->createPointMock());
        $this->symbol->setAnchor(null);

        $this->assertFalse($this->symbol->hasAnchor());
        $this->assertNull($this->symbol->getAnchor());
    }

    public function testLabelOrigin()
    {
        $this->symbol->setLabelOrigin($labelOrigin = $this->createPointMock());

        $this->assertSame($labelOrigin, $this->symbol->getLabelOrigin());
    }

    public function testResetLabelOrigin()
    {
        $this->symbol->setLabelOrigin($this->createPointMock());
        $this->symbol->setLabelOrigin(null);

        $this->assertFalse($this->symbol->hasLabelOrigin());
        $this->assertNull($this->symbol->getLabelOrigin());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Point
     */
    private function createPointMock()
    {
        return $this->createMock(Point::class);
    }
}
