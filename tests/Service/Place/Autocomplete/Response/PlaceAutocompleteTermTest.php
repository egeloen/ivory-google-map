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

use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteTerm;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteTermTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteTerm
     */
    private $match;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->match = new PlaceAutocompleteTerm();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->match->hasValue());
        $this->assertNull($this->match->getValue());
        $this->assertFalse($this->match->hasOffset());
        $this->assertNull($this->match->getOffset());
    }

    public function testValue()
    {
        $this->match->setValue($value = 'foo');

        $this->assertTrue($this->match->hasValue());
        $this->assertSame($value, $this->match->getValue());
    }

    public function testOffset()
    {
        $this->match->setOffset($offset = 2);

        $this->assertTrue($this->match->hasOffset());
        $this->assertSame($offset, $this->match->getOffset());
    }
}
