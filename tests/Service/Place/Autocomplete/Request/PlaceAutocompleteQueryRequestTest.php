<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete\Request;

use Ivory\GoogleMap\Service\Place\Autocomplete\Request\AbstractPlaceAutocompleteRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteQueryRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteQueryRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteQueryRequest
     */
    private $request;

    /**
     * @var string
     */
    private $input;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PlaceAutocompleteQueryRequest($this->input = 'input');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractPlaceAutocompleteRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->input, $this->request->getInput());
        $this->assertFalse($this->request->hasOffset());
        $this->assertNull($this->request->getOffset());
        $this->assertFalse($this->request->hasLocation());
        $this->assertNull($this->request->getLocation());
        $this->assertFalse($this->request->hasRadius());
        $this->assertNull($this->request->getRadius());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }
}
