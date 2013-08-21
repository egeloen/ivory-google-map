<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Utils;

use Ivory\GoogleMap\Helper\Utils\JsonBuilder;

/**
 * Json builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Utils\JsonBuilder */
    protected $jsonBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->jsonBuilder = new JsonBuilder();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->jsonBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame(0, $this->jsonBuilder->getJsonEncodeOptions());
        $this->assertFalse($this->jsonBuilder->hasValues());
        $this->assertEmpty($this->jsonBuilder->getValues());
    }

    public function testJsonEncodeOptions()
    {
        $this->jsonBuilder->setJsonEncodeOptions(JSON_FORCE_OBJECT);

        $this->assertSame(JSON_FORCE_OBJECT, $this->jsonBuilder->getJsonEncodeOptions());
    }

    public function testValues()
    {
        $this->jsonBuilder->setValues(array('foo' => 'bar', 'baz' => array('bat' => 'foo')));

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertSame(array('[foo]' => 'bar', '[baz][bat]' => 'foo'), $this->jsonBuilder->getValues());
    }

    public function testValuesWithIndexArrays()
    {
        $this->jsonBuilder->setValues(array('foo' => array(array('bar' => array('bat' => 'one', 'bau' => 'two')), array('bas' => array('bav' => 'three', 'baw' => 'four')))));

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertSame(array('[foo][0][bar][bat]' => 'one', '[foo][0][bar][bau]' => 'two', '[foo][1][bas][bav]' => 'three', '[foo][1][bas][baw]' => 'four'), $this->jsonBuilder->getValues());
    }

    public function testValue()
    {
        $this->jsonBuilder->setValue('foo', 'bar');

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertSame(array('foo' => 'bar'), $this->jsonBuilder->getValues());

        $this->jsonBuilder->removeValue('foo');

        $this->assertFalse($this->jsonBuilder->hasValues());
        $this->assertEmpty($this->jsonBuilder->getValues());
    }

    public function testSingleBuild()
    {
        $this->jsonBuilder
            ->setValue('[foo]', 'bar')
            ->setValue('[baz]', 'bat', false);

        $this->assertSame('{"foo":"bar","baz":bat}', $this->jsonBuilder->build());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->jsonBuilder
            ->setValue('[foo]', 'bar')
            ->setValue('[baz]', 'bat', false);

        $this->assertSame('{"foo":"bar","baz":bat}', $this->jsonBuilder->build());
        $this->assertSame('{"foo":"bar","baz":bat}', $this->jsonBuilder->build());
    }

    public function testMultipleBuildWithReset()
    {
        $this->jsonBuilder
            ->setValue('[foo]', 'bar')
            ->setValue('[baz]', 'bat', false);

        $this->assertSame('{"foo":"bar","baz":bat}', $this->jsonBuilder->build());
        $this->jsonBuilder->reset();
        $this->assertSame('[]', $this->jsonBuilder->build());
    }
}
