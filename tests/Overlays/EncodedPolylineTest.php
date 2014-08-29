<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\EncodedPolyline;

/**
 * Encoded polyline test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    protected $encodedPolyline;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolyline = new EncodedPolyline();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodedPolyline);
    }

    public function testDefaultState()
    {
        $this->assertNull($this->encodedPolyline->getValue());
    }

    public function testInitialState()
    {
        $this->encodedPolyline = new EncodedPolyline('foo');

        $this->assertSame('foo', $this->encodedPolyline->getValue());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The encoded polyline value must be a string value.
     */
    public function testValueWithInvalidValue()
    {
        $this->encodedPolyline->setValue(true);
    }
}
