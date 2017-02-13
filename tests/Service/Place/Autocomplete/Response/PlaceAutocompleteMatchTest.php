<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete\Response;

use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteMatch;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteMatchTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteMatch
     */
    private $match;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->match = new PlaceAutocompleteMatch();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->match->hasLength());
        $this->assertNull($this->match->getLength());
        $this->assertFalse($this->match->hasOffset());
        $this->assertNull($this->match->getOffset());
    }

    public function testLength()
    {
        $this->match->setLength($length = 12);

        $this->assertTrue($this->match->hasLength());
        $this->assertSame($length, $this->match->getLength());
    }

    public function testOffset()
    {
        $this->match->setOffset($offset = 4);

        $this->assertTrue($this->match->hasOffset());
        $this->assertSame($offset, $this->match->getOffset());
    }
}
