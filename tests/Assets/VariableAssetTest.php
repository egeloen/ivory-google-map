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
 * Variable asset test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class VariableAssetTest extends AbstractTestCase
{
    /** @var string */
    private $variablePatternFormat = '/^%s[a-z0-9]{22}$/';

    /** @var \Ivory\GoogleMap\Assets\AbstractVariableAsset|\PHPUnit_Framework_MockObject_MockObject */
    private $variableAssetMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->variableAssetMock = $this->createVariableAssetMockBuilder()->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->variableAssetMock);
    }

    public function testDefaultState()
    {
        $this->assertRegExp(sprintf($this->variablePatternFormat, null), $this->variableAssetMock->getVariable());
    }

    public function testInitialState()
    {
        $this->variableAssetMock = $this->createVariableAssetMockBuilder()
            ->setConstructorArgs(array($prefix = 'foo'))
            ->getMockForAbstractClass();

        $this->assertRegExp(sprintf($this->variablePatternFormat, $prefix), $this->variableAssetMock->getVariable());
    }

    public function testVariableUnicity()
    {
        $variableAssetMock = $this->createVariableAssetMockBuilder()->getMockForAbstractClass();

        $this->assertNotSame($variableAssetMock->getVariable(), $this->variableAssetMock->getVariable());
    }

    public function testSetVariable()
    {
        $this->variableAssetMock->setVariable($variable = 'foo');

        $this->assertSame($variable, $this->variableAssetMock->getVariable());
    }
}
