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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\ContextualizedRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\AbstractPlaceAutocompleteRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractPlaceAutocompleteRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractPlaceAutocompleteRequest|\PHPUnit_Framework_MockObject_MockObject
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
        $this->request = $this->getMockBuilder(AbstractPlaceAutocompleteRequest::class)
            ->setConstructorArgs([$this->input = 'input'])
            ->getMockForAbstractClass();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(PlaceAutocompleteRequestInterface::class, $this->request);
        $this->assertInstanceOf(ContextualizedRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
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

    public function testInput()
    {
        $this->request->setInput($input = 'foo');

        $this->assertSame($input, $this->request->getInput());
    }

    public function testOffset()
    {
        $this->request->setOffset($offset = 4);

        $this->assertTrue($this->request->hasOffset());
        $this->assertSame($offset, $this->request->getOffset());
    }

    public function testLocation()
    {
        $this->request->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->request->hasLocation());
        $this->assertSame($location, $this->request->getLocation());
    }

    public function testRadius()
    {
        $this->request->setRadius($radius = 123.4);

        $this->assertTrue($this->request->hasRadius());
        $this->assertSame($radius, $this->request->getRadius());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['input' => $this->input], $this->request->buildQuery());
    }

    public function testBuildQueryWithOffset()
    {
        $this->request->setOffset($offset = 3);

        $this->assertSame([
            'input'  => $this->input,
            'offset' => $offset,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithLocation()
    {
        $location = $this->createCoordinateMock();
        $location
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue(1.23));

        $location
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue(3.21));

        $this->request->setLocation($location);

        $this->assertSame([
            'input'    => $this->input,
            'location' => '1.23,3.21',
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithRadius()
    {
        $this->request->setRadius($radius = 123.4);

        $this->assertSame([
            'input'  => $this->input,
            'radius' => $radius,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'input'    => $this->input,
            'language' => $language,
        ], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
