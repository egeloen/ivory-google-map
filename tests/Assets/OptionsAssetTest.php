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
class OptionsAssetTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Assets\AbstractOptionsAsset|\PHPUnit_Framework_MockObject_MockObject */
    private $optionsAssetMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->optionsAssetMock = $this->createOptionsAssetMockBuilder()->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->optionsAssetMock);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->optionsAssetMock);
    }

    public function testDefaultState()
    {
        $this->assertNotEmpty($this->optionsAssetMock->getVariable());
        $this->assertNoOptions();
    }

    public function testInitialState()
    {
        $this->optionsAssetMock = $this->createOptionsAssetMockBuilder()
            ->setConstructorArgs(array($prefix = 'foo', $options = array('bar' => 'baz')))
            ->getMockForAbstractClass();

        $this->assertStringStartsWith($prefix, $this->optionsAssetMock->getVariable());
        $this->assertOptions($options);
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testSetOptions(array $options)
    {
        $this->optionsAssetMock->setOptions($options);

        $this->assertOptions($options);
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testAddOptions(array $options)
    {
        $this->optionsAssetMock->setOptions($options);
        $this->optionsAssetMock->addOptions($newOptions = array('foo' => 'bar'));

        $this->assertOptions(array_merge($options, $newOptions));
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testRemoveOptions(array $options)
    {
        $this->optionsAssetMock->setOptions($options);
        $this->optionsAssetMock->removeOptions(array_keys($options));

        $this->assertNoOptions();
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testResetOptions(array $options)
    {
        $this->optionsAssetMock->setOptions($options);
        $this->optionsAssetMock->resetOptions();

        $this->assertNoOptions();
    }

    /**
     * @dataProvider optionProvider
     */
    public function testSetOption($name, $value)
    {
        $this->optionsAssetMock->setOption($name, $value);

        $this->assertOption($name, $value);
    }

    /**
     * @dataProvider optionProvider
     */
    public function testRemoveOption($name, $value)
    {
        $this->optionsAssetMock->setOption($name, $value);
        $this->optionsAssetMock->removeOption($name);

        $this->assertNoOption($name);
    }

    /**
     * Gets the option provider.
     *
     * @return array The option provider.
     */
    public function optionProvider()
    {
        return array(
            array('string', 'foo'),
            array('boolean', true),
            array('integer', 1),
            array('float', 1.1),
            array('array', array()),
            array('object', new \stdClass()),
            array('null', null),
        );
    }

    /**
     * Gets the options provider.
     *
     * @return array The options provider.
     */
    public function optionsProvider()
    {
        $options = array();

        foreach ($this->optionProvider() as $provider) {
            $options[] = array($provider[0] => $provider[1]);
        }

        return array($options);
    }

    /**
     * Asserts the are options.
     *
     * @param array $options The options.
     */
    private function assertOptions($options)
    {
        $this->assertInternalType('array', $options);

        $this->assertTrue($this->optionsAssetMock->hasOptions());
        $this->assertSame($options, $this->optionsAssetMock->getOptions());

        foreach ($options as $name => $value) {
            $this->assertOption($name, $value);
        }
    }

    /**
     * Asserts there is an option.
     *
     * @param string $name  The option name.
     * @param mixed  $value The option value.
     */
    private function assertOption($name, $value)
    {
        $this->assertTrue($this->optionsAssetMock->hasOption($name));
        $this->assertSame($value, $this->optionsAssetMock->getOption($name));
    }

    /**
     * Asserts there are no options.
     */
    private function assertNoOptions()
    {
        $this->assertFalse($this->optionsAssetMock->hasOptions());
        $this->assertEmpty($this->optionsAssetMock->getOptions());
    }

    /**
     * Asserts there is no option.
     *
     * @param string $name The option name.
     */
    private function assertNoOption($name)
    {
        $this->assertFalse($this->optionsAssetMock->hasOption($name));
        $this->assertNull($this->optionsAssetMock->getOption($name));
    }
}
