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
 * Javascript variable asset test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JavascriptVariableAssetTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset */
    protected $asset;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->asset = $this->getMockForAbstractClass('Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset');
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
    }

    public function testInitialState()
    {
        $this->asset = $this->getMockBuilder('Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset')
            ->setConstructorArgs(array('foo'))
            ->getMockForAbstractClass();

        $this->assertSame('foo', $this->asset->getJavascriptVariable());
    }

    public function testjavascriptVariableWithValidVariable()
    {
        $this->asset->setJavascriptVariable('foo');

        $this->assertSame('foo', $this->asset->getJavascriptVariable());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The javascript variable must be a string value.
     */
    public function testJavascriptVariableWithInvalidVariable()
    {
        $this->asset->setJavascriptVariable(true);
    }

    public function testPrefixJavascriptVariableWithValidPrefix()
    {
        $this->asset->setPrefixJavascriptVariable('foo');

        $this->assertSame('foo', substr($this->asset->getJavascriptVariable(), 0, 3));
        $this->assertGreaterThan(3, strlen($this->asset->getJavascriptVariable()));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\AssetException
     * @expectedExceptionMessage The prefix of a javascript variable must be a string value.
     */
    public function testPrefixJavascriptVariableWithInvalidPrefix()
    {
        $this->asset->setPrefixJavascriptVariable(true);
    }
}
