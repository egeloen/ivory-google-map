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
        $this->assertFalse($this->request->hasRegion());
        $this->assertNull($this->request->getRegion());
        $this->assertFalse($this->request->hasSessionToken());
        $this->assertNull($this->request->getSessionToken());
        $this->assertFalse($this->request->hasSpecificFields());
        $this->assertNull($this->request->getFields());
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

    public function testRegion()
    {
        $this->request->setRegion($region = 'uk');

        $this->assertTrue($this->request->hasRegion());
        $this->assertSame($region, $this->request->getRegion());
    }

    public function testSessionToken()
    {
        $this->request->setSessionToken($token = 'session_token');

        $this->assertTrue($this->request->hasSessionToken());
        $this->assertSame($token, $this->request->getSessionToken());
    }

    public function testFields()
    {
        $this->request->withoutAtmosphereFields();

        $expected = array_merge(PlaceDetailRequest::FIELDS_BASIC, PlaceDetailRequest::FIELDS_CONTACT);
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals($expected, $this->request->getFields(), 'Testing withoutAtmosphereFields Function', 0.0, 10, true);

        $this->request->withFields('photo ');
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals($expected, $this->request->getFields(), 'Testing adding a duplicate field', 0.0, 10, true);

        $this->request->withoutFields(' photo');
        $this->request->withFields('invalid_field');
        $expected_1 = array_diff($expected, ['photo']);
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals($expected_1, $this->request->getFields(), 'Testing removing a field and adding an invalid field', 0.0, 10, true);

        $this->request->withFields(' photo, review ');
        $expected_1 = array_merge($expected, ['review']);
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals($expected_1, $this->request->getFields(), 'Testing adding 2 non duplicate fields from 2 different field sets', 0.0, 10, true);

        $this->request->withAllFields();
        $this->assertFalse($this->request->hasSpecificFields());
        $this->assertNull($this->request->getFields());

        $this->request->withFields('review');
        $this->request->withOnlyFields(array_merge(['photo '], $expected = ['name', 'photo', 'website', 'opening_hours']));
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals($expected, $this->request->getFields(), 'Testing withOnlyFields', 0.0, 10, true);

        $this->request->withoutContactFields();
        $this->assertTrue($this->request->hasSpecificFields());
        $this->assertEquals(array_diff($expected, PlaceDetailRequest::FIELDS_CONTACT), $this->request->getFields(), 'Testing withoutContactFields', 0.0, 10, true);

        $this->request->withoutBasicFields();
        $this->assertFalse($this->request->hasSpecificFields());
        $this->assertNull($this->request->getFields());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['placeid' => $this->placeId], $this->request->buildQuery());
    }

    public function testBuildQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame([
            'placeid' => $this->placeId,
            'language' => $language,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithRegion()
    {
        $this->request->setRegion($region = 'uk');

        $this->assertSame([
            'placeid' => $this->placeId,
            'region' => $region,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithSessionToken()
    {
        $this->request->setSessionToken($token = 'token');

        $this->assertSame([
            'placeid' => $this->placeId,
            'sessiontoken' => $token,
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithBasicFields()
    {
        $this->request->withFields($fields = PlaceDetailRequest::FIELDS_BASIC);

        $this->assertSame([
            'placeid' => $this->placeId,
            'fields' => join(',', $fields),
        ], $this->request->buildQuery());
    }

    public function testBuildQueryWithSpecificFields()
    {
        $this->request->withFields($fields ='icon,name,url,photo,invalid_field,website, rating , review,user_ratings_total ');

        $this->assertSame([
            'placeid' => $this->placeId,
            'fields' => 'icon,name,url,photo,website,rating,review,user_ratings_total',
        ], $this->request->buildQuery());
    }
}
