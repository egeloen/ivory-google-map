<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Detail\Request;

use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceDetailRequest
     */
    private $request;

    /**
     * @var string
     */
    private $placeId;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PlaceDetailRequest($this->placeId = 'place');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(PlaceDetailRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->placeId, $this->request->getPlaceId());
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testPlaceId()
    {
        $this->request->setPlaceId($placeId = 'foo');

        $this->assertSame($placeId, $this->request->getPlaceId());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['placeid' => $this->placeId], $this->request->buildQuery());
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'placeid'  => $this->placeId,
            'language' => $language,
        ], $this->request->buildQuery());
    }
}
