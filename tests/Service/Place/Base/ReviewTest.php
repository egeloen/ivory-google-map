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

use Ivory\GoogleMap\Service\Place\Base\AspectRating;
use Ivory\GoogleMap\Service\Place\Base\Review;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ReviewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Review
     */
    private $review;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->review = new Review();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->review->hasAuthorName());
        $this->assertNull($this->review->getAuthorName());
        $this->assertFalse($this->review->hasAuthorUrl());
        $this->assertNull($this->review->getAuthorUrl());
        $this->assertFalse($this->review->hasText());
        $this->assertNull($this->review->getText());
        $this->assertFalse($this->review->hasRating());
        $this->assertNull($this->review->getRating());
        $this->assertFalse($this->review->hasTime());
        $this->assertNull($this->review->getTime());
        $this->assertFalse($this->review->hasLanguage());
        $this->assertNull($this->review->getLanguage());
        $this->assertFalse($this->review->hasAspects());
        $this->assertEmpty($this->review->getAspects());
    }

    public function testAuthorName()
    {
        $this->review->setAuthorName($authorName = 'name');

        $this->assertTrue($this->review->hasAuthorName());
        $this->assertSame($authorName, $this->review->getAuthorName());
    }

    public function testAuthorUrl()
    {
        $this->review->setAuthorUrl($authorUrl = 'url');

        $this->assertTrue($this->review->hasAuthorUrl());
        $this->assertSame($authorUrl, $this->review->getAuthorUrl());
    }

    public function testText()
    {
        $this->review->setText($text = 'foo');

        $this->assertTrue($this->review->hasText());
        $this->assertSame($text, $this->review->getText());
    }

    public function testRating()
    {
        $this->review->setRating($rating = 1.2);

        $this->assertTrue($this->review->hasRating());
        $this->assertSame($rating, $this->review->getRating());
    }

    public function testTime()
    {
        $this->review->setTime($time = new \DateTime());

        $this->assertTrue($this->review->hasTime());
        $this->assertSame($time, $this->review->getTime());
    }

    public function testLanguage()
    {
        $this->review->setLanguage($language = 'fr');

        $this->assertTrue($this->review->hasLanguage());
        $this->assertSame($language, $this->review->getLanguage());
    }

    public function testSetAspects()
    {
        $this->review->setAspects($aspects = [$aspect = $this->createAspectRatingMock()]);
        $this->review->setAspects($aspects);

        $this->assertTrue($this->review->hasAspects());
        $this->assertTrue($this->review->hasAspect($aspect));
        $this->assertSame($aspects, $this->review->getAspects());
    }

    public function testAddAspects()
    {
        $this->review->setAspects($firstAspects = [$this->createAspectRatingMock()]);
        $this->review->addAspects($secondAspects = [$this->createAspectRatingMock()]);

        $this->assertTrue($this->review->hasAspects());
        $this->assertSame(array_merge($firstAspects, $secondAspects), $this->review->getAspects());
    }

    public function testAddAspect()
    {
        $this->review->addAspect($aspect = $this->createAspectRatingMock());

        $this->assertTrue($this->review->hasAspects());
        $this->assertTrue($this->review->hasAspect($aspect));
        $this->assertSame([$aspect], $this->review->getAspects());
    }

    public function testRemoveAspect()
    {
        $this->review->addAspect($aspect = $this->createAspectRatingMock());
        $this->review->removeAspect($aspect);

        $this->assertFalse($this->review->hasAspects());
        $this->assertFalse($this->review->hasAspect($aspect));
        $this->assertEmpty($this->review->getAspects());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AspectRating
     */
    private function createAspectRatingMock()
    {
        return $this->createMock(AspectRating::class);
    }
}
