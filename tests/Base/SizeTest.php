<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Size
     */
    private $size;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->size = new Size();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->size);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('size', $this->size->getVariable());
        $this->assertSame(1.0, $this->size->getWidth());
        $this->assertSame(1.0, $this->size->getHeight());
        $this->assertFalse($this->size->hasUnits());
        $this->assertFalse($this->size->hasWidthUnit());
        $this->assertFalse($this->size->hasHeightUnit());
        $this->assertNull($this->size->getWidthUnit());
        $this->assertNull($this->size->getHeightUnit());
    }

    public function testInitialState()
    {
        $this->size = new Size($width = 1.2, $height = 2.3, $widthUnit = 'px', $heightUnit = '%');

        $this->assertSame($width, $this->size->getWidth());
        $this->assertSame($height, $this->size->getHeight());
        $this->assertTrue($this->size->hasUnits());
        $this->assertTrue($this->size->hasWidthUnit());
        $this->assertTrue($this->size->hasHeightUnit());
        $this->assertSame($widthUnit, $this->size->getWidthUnit());
        $this->assertSame($heightUnit, $this->size->getHeightUnit());
    }

    public function testWidth()
    {
        $this->size->setWidth($width = 1.2);

        $this->assertSame($width, $this->size->getWidth());
    }

    public function testHeight()
    {
        $this->size->setHeight($height = 1.2);

        $this->assertSame($height, $this->size->getHeight());
    }

    public function testWidthUnit()
    {
        $this->size->setWidthUnit($widthUnit = 'px');

        $this->assertFalse($this->size->hasUnits());
        $this->assertTrue($this->size->hasWidthUnit());
        $this->assertSame($widthUnit, $this->size->getWidthUnit());
    }

    public function testHeightUnit()
    {
        $this->size->setHeightUnit($heightUnit = 'px');

        $this->assertFalse($this->size->hasUnits());
        $this->assertTrue($this->size->hasHeightUnit());
        $this->assertSame($heightUnit, $this->size->getHeightUnit());
    }

    public function testUnits()
    {
        $this->size->setWidthUnit('px');
        $this->size->setHeightUnit('px');

        $this->assertTrue($this->size->hasUnits());
    }
}
