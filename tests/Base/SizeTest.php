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
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Size test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Base\Size */
    private $size;

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->size = new Size($this->width = 1, $this->height = 2);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->size);
        unset($this->width);
        unset($this->height);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->size);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('size_', $this->size->getVariable());
        $this->assertSizes($this->width, $this->height);
        $this->assertNoUnits();
    }

    public function testInitialState()
    {
        $this->size = new Size($this->width, $this->height, $widthUnit = 'px', $heightUnit = '%');

        $this->assertSizes($this->width, $this->height);
        $this->assertUnits($widthUnit, $heightUnit);
    }

    public function testSetWidth()
    {
        $this->size->setWidth($width = 10);

        $this->assertWidth($width);
    }

    public function testSetHeight()
    {
        $this->size->setHeight($height = 10);

        $this->assertHeight($height);
    }

    public function testSetWidthUnit()
    {
        $this->size->setWidthUnit($widthUnit = 'em');

        $this->assertWidthUnit($widthUnit);
    }

    public function testResetWidthUnit()
    {
        $this->size->setWidthUnit('em');
        $this->size->setWidthUnit(null);

        $this->assertNoWidthUnit();
    }

    public function testSetHeightUnit()
    {
        $this->size->setHeightUnit($heightUnit = 'em');

        $this->assertHeightUnit($heightUnit);
    }

    public function testResetHeightUnit()
    {
        $this->size->setHeightUnit('em');
        $this->size->setHeightUnit(null);

        $this->assertNoHeightUnit();
    }

    /**
     * Asserts the sizes.
     *
     * @param float $width  The width.
     * @param float $height The height.
     */
    private function assertSizes($width, $height)
    {
        $this->assertWidth($width);
        $this->assertHeight($height);
    }

    /**
     * Asserts the width.
     *
     * @param float $width The width.
     */
    private function assertWidth($width)
    {
        $this->assertSame($width, $this->size->getWidth());
    }

    /**
     * Asserts the height.
     *
     * @param float $height The height.
     */
    private function assertHeight($height)
    {
        $this->assertSame($height, $this->size->getHeight());
    }

    /**
     * Asserts the units.
     *
     * @param string $widthUnit  The width unit.
     * @param string $heightUnit The height unit.
     */
    private function assertUnits($widthUnit, $heightUnit)
    {
        $this->assertWidthUnit($widthUnit);
        $this->assertHeightUnit($heightUnit);
    }

    /**
     * Asserts the width unit.
     *
     * @param string $widthUnit The width unit.
     */
    private function assertWidthUnit($widthUnit)
    {
        $this->assertTrue($this->size->hasWidthUnit());
        $this->assertSame($widthUnit, $this->size->getWidthUnit());
    }

    /**
     * Asserts the height unit.
     *
     * @param string $heightUnit The height unit.
     */
    private function assertHeightUnit($heightUnit)
    {
        $this->assertTrue($this->size->hasHeightUnit());
        $this->assertSame($heightUnit, $this->size->getHeightUnit());
    }

    /**
     * Asserts there are no units.
     */
    private function assertNoUnits()
    {
        $this->assertNoWidthUnit();
        $this->assertNoHeightUnit();
    }

    /**
     * Asserts there is no width unit.
     */
    private function assertNoWidthUnit()
    {
        $this->assertFalse($this->size->hasWidthUnit());
        $this->assertNull($this->size->getWidthUnit());
    }

    /**
     * Asserts there is no height unit.
     */
    private function assertNoHeightUnit()
    {
        $this->assertFalse($this->size->hasHeightUnit());
        $this->assertNull($this->size->getHeightUnit());
    }
}
