<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderCoordinateRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResponse;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderStatus;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceTest extends AbstractSerializableServiceTest
{
    /**
     * @var GeocoderService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->service = new GeocoderService($this->client, $this->messageFactory);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddress($format)
    {
        $request = $this->createAddressRequest();

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithComponents($format)
    {
        $request = new GeocoderAddressRequest('Grand place');
        $request->setComponents([
            GeocoderComponentType::COUNTRY     => 'fr',
            GeocoderComponentType::POSTAL_CODE => 59800,
        ]);

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithBound($format)
    {
        $request = $this->createAddressRequest();
        $request->setBound(new Bound(
            new Coordinate(48.815573, 2.224199),
            new Coordinate(48.9021449, 2.4699208)
        ));

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithRegion($format)
    {
        $request = $this->createAddressRequest();
        $request->setRegion('fr');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithLanguage($format)
    {
        $request = $this->createAddressRequest();
        $request->setLanguage('pl');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocoderCoordinate($format)
    {
        $request = $this->createCoordinateRequest();

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocoderCoordinateWithLanguage($format)
    {
        $request = $this->createCoordinateRequest();
        $request->setLanguage('pl');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @return GeocoderAddressRequest
     */
    protected function createAddressRequest()
    {
        return new GeocoderAddressRequest('Paris');
    }

    /**
     * @return GeocoderCoordinateRequest
     */
    protected function createCoordinateRequest()
    {
        return new GeocoderCoordinateRequest(new Coordinate(48.858369, 2.294482));
    }

    /**
     * @param GeocoderResponse         $response
     * @param GeocoderRequestInterface $request
     */
    protected function assertGeocoderResponse($response, $request)
    {
        $options = array_merge([
            'status'  => GeocoderStatus::OK,
            'results' => [],
        ], self::$journal->getData());

        $this->assertInstanceOf(GeocoderResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['status'], $response->getStatus());
        $this->assertCount(count($options['results']), $results = $response->getResults());

        foreach ($options['results'] as $key => $result) {
            $this->assertArrayHasKey($key, $results);
            $this->assertGeocoderResult($results[$key], $result);
        }
    }

    /**
     * @param GeocoderResult $result
     * @param mixed[]        $options
     */
    private function assertGeocoderResult($result, array $options = [])
    {
        $options = array_merge([
            'place_id'            => null,
            'formatted_address'   => null,
            'partial_match'       => null,
            'types'               => [],
            'postcode_localities' => [],
            'address_components'  => [],
            'geometry'            => [],
        ], $options);

        $this->assertInstanceOf(GeocoderResult::class, $result);

        $this->assertSame($options['place_id'], $result->getPlaceId());
        $this->assertSame($options['formatted_address'], $result->getFormattedAddress());
        $this->assertSame($options['partial_match'], $result->isPartialMatch());
        $this->assertSame($options['types'], $result->getTypes());

        $this->assertCount(
            count($options['address_components']),
            $addressComponents = $result->getAddressComponents()
        );

        foreach ($options['address_components'] as $key => $addressComponent) {
            $this->assertArrayHasKey($key, $addressComponents);
            $this->assertAddressComponent($addressComponents[$key], $addressComponent);
        }

        $this->assertGeometry($result->getGeometry(), $options['geometry']);
    }
}
