<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Assets;

/**
 * Options asset test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionsAssetTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Assets\AbstractOptionsAsset */
    protected $asset;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->asset = $this->getMockForAbstractClass('Ivory\GoogleMap\Assets\AbstractOptionsAsset');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->asset);
    }

    public function testDefaultState()
    {
        $this->assertInternalType('string', $this->asset->getJavascriptVariable());
        $this->assertEmpty($this->asset->getOptions());
    }

    public function testInitialState()
    {
        $this->asset = $this->getMockBuilder('Ivory\GoogleMap\Assets\AbstractOptionsAsset')
            ->setConstructorArgs(array('foo', array('foo' => 'bar')))
            ->getMockForAbstractClass();

        $this->assertSame('foo', $this->asset->getJavascriptVariable());
        $this->assertSame(array('foo' => 'bar'), $this->asset->getOptions());
    }

    public function testOptions()
    {
        $this->asset->setOptions(array('foo' => 'bar'));

        $this->assertTrue($this->asset->hasOptions());
        $this->assertSame(array('foo' => 'bar'), $this->asset->getOptions());

        $this->assertTrue($this->asset->hasOption('foo'));
        $this->assertSame('bar', $this->asset->getOption('foo'));

        $this->asset->removeOption('foo');

        $this->assertFalse($this->asset->hasOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The option property must be a string value.
     */
    public function testHasOptionWithInvalidOption()
    {
        $this->asset->hasOption(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The option "foo" does not exist.
     */
    public function testGetOptionWithInvalidOption()
    {
        $this->asset->getOption('foo');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The option property must be a string value.
     */
    public function testSetOptionWithInvalidOption()
    {
        $this->asset->setOption(true, false);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The option "foo" does not exist.
     */
    public function testRemoveOptionWithInvalidOption()
    {
        $this->asset->removeOption('foo');
    }
}
