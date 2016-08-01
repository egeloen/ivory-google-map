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

use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolyline
     */
    private $encodedPolyline;

    /**
     * @var string
     */
    private $value;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolyline = new EncodedPolyline($this->value = '_p~iF~ps|U_ulLnnqC_mqNvxq`@');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->encodedPolyline);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->encodedPolyline);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->encodedPolyline);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('encoded_polyline', $this->encodedPolyline->getVariable());
        $this->assertSame($this->value, $this->encodedPolyline->getValue());
        $this->assertFalse($this->encodedPolyline->hasOptions());
    }

    public function testInitialState()
    {
        $this->encodedPolyline = new EncodedPolyline($this->value, $options = ['foo' => 'bar']);

        $this->assertStringStartsWith('encoded_polyline', $this->encodedPolyline->getVariable());
        $this->assertSame($this->value, $this->encodedPolyline->getValue());
        $this->assertSame($options, $this->encodedPolyline->getOptions());
    }

    public function testValue()
    {
        $this->encodedPolyline->setValue($value = 'foo');

        $this->assertSame($value, $this->encodedPolyline->getValue());
    }
}
