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
class EncodedPolylineTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    private $encodedPolyline;

    /** @var string */
    private $value;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolyline = new EncodedPolyline($this->value = 'value');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->value);
        unset($this->encodedPolyline);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->encodedPolyline);
        $this->assertExtendableInstance($this->encodedPolyline);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('encoded_polyline_', $this->encodedPolyline->getVariable());
        $this->assertSame($this->value, $this->encodedPolyline->getValue());
        $this->assertFalse($this->encodedPolyline->hasOptions());
    }

    public function testSetValue()
    {
        $this->encodedPolyline->setValue($value = 'foo');

        $this->assertSame($value, $this->encodedPolyline->getValue());
    }

    public function testRenderExtend()
    {
        $this->encodedPolyline->setVariable('encoded_polyline');

        $this->assertSame(
            'encoded_polyline.getPath().forEach(function(e){bound.extend(e);})',
            $this->encodedPolyline->renderExtend($this->createBoundMock())
        );
    }
}
