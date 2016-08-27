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
use Ivory\GoogleMap\Service\Place\Base\AspectRatingType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AspectRatingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AspectRating
     */
    private $aspectRating;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->aspectRating = new AspectRating();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->aspectRating->hasType());
        $this->assertNull($this->aspectRating->getType());
        $this->assertFalse($this->aspectRating->hasRating());
        $this->assertNull($this->aspectRating->getRating());
    }

    public function testType()
    {
        $this->aspectRating->setType($type = AspectRatingType::DECOR);

        $this->assertTrue($this->aspectRating->hasType());
        $this->assertSame($type, $this->aspectRating->getType());
    }

    public function testRating()
    {
        $this->aspectRating->setRating($rating = 1.2);

        $this->assertTrue($this->aspectRating->hasRating());
        $this->assertSame($rating, $this->aspectRating->getRating());
    }
}
