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

/**
 * Size test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Base\Size */
    protected $size;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->size = new Size();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->size);
    }

    public function testDefaultState()
    {
        $this->assertSame('size_', substr($this->size->getJavascriptVariable(), 0, 5));

        $this->assertSame(1, $this->size->getWidth());
        $this->assertSame(1, $this->size->getHeight());

        $this->assertFalse($this->size->hasUnits());
        $this->assertNull($this->size->getWidthUnit());
        $this->assertNull($this->size->getHeightUnit());
    }

    public function testInitialState()
    {
        $this->size = new Size(2, 3, 'px', '%');

        $this->assertSame(2, $this->size->getWidth());
        $this->assertSame(3, $this->size->getHeight());

        $this->assertTrue($this->size->hasUnits());
        $this->assertSame('px', $this->size->getWidthUnit());
        $this->assertSame('%', $this->size->getHeightUnit());
    }

    public function testWidthWithValidValue()
    {
        $this->size->setWidth(2);

        $this->assertSame(2, $this->size->getWidth());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The width of a size must be a numeric value.
     */
    public function testWidthWithInvalidValue()
    {
        $this->size->setWidth(true);
    }

    public function testHeightWithValidValue()
    {
        $this->size->setHeight(2);

        $this->assertSame(2, $this->size->getHeight());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The height of a size must be a numeric value.
     */
    public function testHeightWithInvalidValue()
    {
        $this->size->setHeight(true);
    }

    public function testWidthUnitWithValidValue()
    {
        $this->size->setWidthUnit('px');

        $this->assertSame('px', $this->size->getWidthUnit());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The width unit of a size must be a string value.
     */
    public function testWidthUnitWithInvalidValue()
    {
        $this->size->setWidthUnit(true);
    }

    public function testHeightUnitWithValidValue()
    {
        $this->size->setHeightUnit('px');

        $this->assertSame('px', $this->size->getHeightUnit());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The height unit of a size must be a string value.
     */
    public function testHeightUnitWithInvalidValue()
    {
        $this->size->setHeightUnit(true);
    }
}
