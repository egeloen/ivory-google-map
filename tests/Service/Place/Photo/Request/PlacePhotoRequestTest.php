<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Photo\Request;

use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequestInterface;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlacePhotoRequest
     */
    private $request;

    /**
     * @var string
     */
    private $reference;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PlacePhotoRequest($this->reference = 'foo');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(PlacePhotoRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->reference, $this->request->getReference());
        $this->assertFalse($this->request->hasMaxWidth());
        $this->assertNull($this->request->getMaxWidth());
        $this->assertFalse($this->request->hasMaxHeight());
        $this->assertNull($this->request->getMaxHeight());
    }

    public function testReference()
    {
        $this->request->setReference($reference = 'reference');

        $this->assertSame($reference, $this->request->getReference());
    }

    public function testMaxWidth()
    {
        $this->request->setMaxWidth($maxWidth = 100);

        $this->assertTrue($this->request->hasMaxWidth());
        $this->assertSame($maxWidth, $this->request->getMaxWidth());
    }

    public function testMaxHeight()
    {
        $this->request->setMaxHeight($maxHeight = 100);

        $this->assertTrue($this->request->hasMaxHeight());
        $this->assertSame($maxHeight, $this->request->getMaxHeight());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['photoreference' => $this->reference], $this->request->buildQuery());
    }

    public function testBuildQueryWithMaxWidth()
    {
        $this->request->setMaxWidth($maxWidth = 100);

        $this->assertSame([
            'photoreference' => $this->reference,
            'maxwidth'       => $maxWidth,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithMaxHeight()
    {
        $this->request->setMaxHeight($maxHeight = 100);

        $this->assertSame([
            'photoreference' => $this->reference,
            'maxheight'      => $maxHeight,
        ], $this->request->buildQuery());
    }
}
