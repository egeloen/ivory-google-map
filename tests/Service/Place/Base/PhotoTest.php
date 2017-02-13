<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Place\Base\Photo;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PhotoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Photo
     */
    private $photo;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->photo = new Photo();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->photo->hasReference());
        $this->assertNull($this->photo->getReference());
        $this->assertFalse($this->photo->hasWidth());
        $this->assertNull($this->photo->getWidth());
        $this->assertFalse($this->photo->hasHeight());
        $this->assertNull($this->photo->getHeight());
        $this->assertFalse($this->photo->hasHtmlAttributions());
        $this->assertEmpty($this->photo->getHtmlAttributions());
    }

    public function testReference()
    {
        $this->photo->setReference($reference = 'ref');

        $this->assertTrue($this->photo->hasReference());
        $this->assertSame($reference, $this->photo->getReference());
    }

    public function testWidth()
    {
        $this->photo->setWidth($width = 1234);

        $this->assertTrue($this->photo->hasWidth());
        $this->assertSame($width, $this->photo->getWidth());
    }

    public function testHeight()
    {
        $this->photo->setHeight($height = 1234);

        $this->assertTrue($this->photo->hasHeight());
        $this->assertSame($height, $this->photo->getHeight());
    }

    public function testSetHtmlAttributions()
    {
        $this->photo->setHtmlAttributions($htmlAttributions = [$htmlAttribution = 'attribution']);
        $this->photo->setHtmlAttributions($htmlAttributions);

        $this->assertTrue($this->photo->hasHtmlAttributions());
        $this->assertTrue($this->photo->hasHtmlAttribution($htmlAttribution));
        $this->assertSame($htmlAttributions, $this->photo->getHtmlAttributions());
    }

    public function testAddHtmlAttributions()
    {
        $this->photo->setHtmlAttributions($firstHtmlAttributions = ['attribution1']);
        $this->photo->addHtmlAttributions($secondHtmlAttributions = ['attribution2']);

        $this->assertTrue($this->photo->hasHtmlAttributions());
        $this->assertSame(
            array_merge($firstHtmlAttributions, $secondHtmlAttributions),
            $this->photo->getHtmlAttributions()
        );
    }

    public function testAddHtmlAttribution()
    {
        $this->photo->addHtmlAttribution($htmlAttribution = 'attribution');

        $this->assertTrue($this->photo->hasHtmlAttributions());
        $this->assertTrue($this->photo->hasHtmlAttribution($htmlAttribution));
        $this->assertSame([$htmlAttribution], $this->photo->getHtmlAttributions());
    }

    public function testRemoveHtmlAttribution()
    {
        $this->photo->addHtmlAttribution($htmlAttribution = 'attribution');
        $this->photo->removeHtmlAttribution($htmlAttribution);

        $this->assertFalse($this->photo->hasHtmlAttributions());
        $this->assertFalse($this->photo->hasHtmlAttribution($htmlAttribution));
        $this->assertEmpty($this->photo->getHtmlAttributions());
    }
}
