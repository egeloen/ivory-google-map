<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

use Geocoder\Provider\ProviderInterface;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\AbstractService;
use Ivory\GoogleMap\Services\BusinessAccount;
use Ivory\GoogleMap\Services\Utils\XmlParser;
use Ivory\HttpAdapter\HttpAdapterInterface;

/**
 * Geocoder provider.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderProvider extends AbstractService implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        $url = 'http://maps.googleapis.com/maps/api/geocode',
        $https = false,
        $format = self::FORMAT_JSON,
        XmlParser $xmlParser = null,
        BusinessAccount $businessAccount = null
    ) {
        parent::__construct($httpAdapter, $url, $https, $format, $xmlParser, $businessAccount);
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxResults($maxResults)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGeocodedData($geocoderRequest)
    {
        return $this->buildResponse($this->parse(
            (string) $this->getHttpAdapter()->get($this->generateUrl($geocoderRequest))->getBody()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getReversedData(array $coordinates)
    {
        return $this->getGeocodedData(new GeocoderRequest(new Coordinate($coordinates[0], $coordinates[1])));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }

    /**
     * Generates the url.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderRequest $request The request.
     *
     * @return string The generated url.
     */
    private function generateUrl(GeocoderRequest $request)
    {
        $httpQuery = array();

        $location = $request->getLocation();

        if ($location instanceof Coordinate) {
            $httpQuery['latlng'] = $location->getLatitude().','.$location->getLongitude();
        } else {
            $httpQuery['address'] = $location;
        }

        if ($request->hasBound()) {
            $httpQuery['bound'] = $request->getBound()->getSouthWest()->getLatitude().','
                .$request->getBound()->getSouthWest()->getLongitude().'|'
                .$request->getBound()->getNorthEast()->getLatitude().','
                .$request->getBound()->getNorthEast()->getLongitude();
        }

        if ($request->hasRegion()) {
            $httpQuery['region'] = $request->getRegion();
        }

        if ($request->hasLanguage()) {
            $httpQuery['language'] = $request->getLanguage();
        }

        $httpQuery['sensor'] = $request->hasSensor() ? 'true' : 'false';

        return $this->signUrl($this->getUrl().'/'.$this->getFormat().'?'.http_build_query($httpQuery));
    }

    /**
     * Parses the body.
     *
     * @param string $body The body.
     *
     * @return array The parsed body.
     */
    private function parse($body)
    {
        return $this->getFormat() == self::FORMAT_JSON ? $this->parseJson($body) : $this->parseXml($body);
    }

    /**
     * Parses a json body.
     *
     * @param string $body The body.
     *
     * @return array The parsed body.
     */
    private function parseJson($body)
    {
        return json_decode($body, true);
    }

    /**
     * Parses an xml body.
     *
     * @param string $body The body.
     *
     * @return array The parsed body.
     */
    private function parseXml($body)
    {
        return $this->getXmlParser()->parse(
            $body,
            array(
                'address_component' => 'address_components',
                'type'              => 'types',
                'result'            => 'results',
            )
        );
    }

    /**
     * Builds the response.
     *
     * @param array $response The response.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderResponse The built response.
     */
    private function buildResponse(array $response)
    {
        return new GeocoderResponse($this->buildResults($response['results']), $response['status']);
    }

    /**
     * Builds the results.
     *
     * @param array $results The results.
     *
     * @return array The buildt results.
     */
    private function buildResults(array $results)
    {
        $build = array();
        foreach ($results as $result) {
            $build[] = $this->buildResult($result);
        }

        return $build;
    }

    /**
     * Builds a result.
     *
     * @param array $result The result.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderResult The built result.
     */
    private function buildResult(array $result)
    {
        return new GeocoderResult(
            $this->buildAddressComponents($result['address_components']),
            $result['formatted_address'],
            $this->buildGeometry($result['geometry']),
            $result['types'],
            isset($result['partial_match']) ? $result['partial_match'] : null
        );
    }

    /**
     * Builds the address components.
     *
     * @param array $addressComponents The address components.
     *
     * @return array The built address components.
     */
    private function buildAddressComponents(array $addressComponents)
    {
        $build = array();
        foreach ($addressComponents as $addressComponent) {
            $build[] = $this->buildAddressComponent($addressComponent);
        }

        return $build;
    }

    /**
     * Builds an address component.
     *
     * @param array $addressComponent The address component.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent The built address component.
     */
    private function buildAddressComponent(array $addressComponent)
    {
        return new GeocoderAddressComponent(
            $addressComponent['long_name'],
            $addressComponent['short_name'],
            $addressComponent['types']
        );
    }

    /**
     * Builds a geometry.
     *
     * @param array $geometry The geomety.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry The built geometry.
     */
    private function buildGeometry(array $geometry)
    {
        return new GeocoderGeometry(
            new Coordinate(
                $geometry['location']['lat'],
                $geometry['location']['lng']
            ),
            $geometry['location_type'],
            new Bound(
                new Coordinate($geometry['viewport']['southwest']['lat'], $geometry['viewport']['southwest']['lng']),
                new Coordinate($geometry['viewport']['northeast']['lat'], $geometry['viewport']['northeast']['lng'])
            ),
            isset($geometry['bounds']) ? new Bound(
                new Coordinate($geometry['bounds']['southwest']['lat'], $geometry['bounds']['southwest']['lng']),
                new Coordinate($geometry['bounds']['northeast']['lat'], $geometry['bounds']['northeast']['lng'])
            ) : null
        );
    }
}
