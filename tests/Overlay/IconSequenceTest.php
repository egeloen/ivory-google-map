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

use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequenceTest extends TestCase
{
    /**
     * @var IconSequence
     */
    private $iconSequence;

    /**
     * @var Symbol|\PHPUnit_Framework_MockObject_MockObject
     */
    private $symbol;

    protected function setUp(): void
    {
        $this->iconSequence = new IconSequence($this->symbol = $this->createSymbolMock());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->iconSequence);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->iconSequence);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->symbol, $this->iconSequence->getSymbol());
        $this->assertFalse($this->iconSequence->hasOptions());
    }

    public function testInitialState()
    {
        $this->iconSequence = new IconSequence(
            $this->symbol,
            $options = ['foo' => 'bar']
        );

        $this->assertSame($options, $this->iconSequence->getOptions());
    }

    public function testSymbol()
    {
        $this->iconSequence->setSymbol($symbol = $this->createSymbolMock());

        $this->assertSame($symbol, $this->iconSequence->getSymbol());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Symbol
     */
    private function createSymbolMock()
    {
        return $this->createMock(Symbol::class);
    }
}
