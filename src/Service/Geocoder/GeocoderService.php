<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderAddress;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderGeometry;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResponse;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderService extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/geocode', $parser);
    }

    /**
     * @param GeocoderRequestInterface $request
     *
     * @return GeocoderResponse
     */
    public function geocode(GeocoderRequestInterface $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->build()));
        $data = $this->parse((string) $response->getBody(), [
            'pluralization_rules' => [
                'address_component' => 'address_components',
                'type'              => 'types',
                'result'            => 'results',
            ],
        ]);

        return $this->buildResponse($data);
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderResponse
     */
    private function buildResponse(array $data)
    {
        $response = new GeocoderResponse();
        $response->setStatus($data['status']);
        $response->setResults($this->buildResults($data['results']));

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderResult[]
     */
    private function buildResults(array $data)
    {
        $results = [];

        foreach ($data as $response) {
            $results[] = $this->buildResult($response);
        }

        return $results;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderResult
     */
    private function buildResult(array $data)
    {
        $result = new GeocoderResult();
        $result->setAddresses($this->buildAddresses($data['address_components']));
        $result->setGeometry($this->buildGeometry($data['geometry']));
        $result->setPlaceId($data['place_id']);
        $result->setFormattedAddress($data['formatted_address']);

        if (isset($data['types'])) {
            $result->setTypes($data['types']);
        }

        if (isset($data['partial_match'])) {
            $result->setPartialMatch($data['partial_match']);
        }

        return $result;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderAddress[]
     */
    private function buildAddresses(array $data)
    {
        $addresses = [];

        foreach ($data as $address) {
            $addresses[] = $this->buildAddress($address);
        }

        return $addresses;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderAddress
     */
    private function buildAddress(array $data)
    {
        $address = new GeocoderAddress();
        $address->setLongName($data['long_name']);
        $address->setShortName($data['short_name']);
        $address->setTypes($data['types']);

        return $address;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderGeometry
     */
    private function buildGeometry(array $data)
    {
        $geometry = new GeocoderGeometry();
        $geometry->setLocation($this->buildCoordinate($data['location']));
        $geometry->setViewport($this->buildBound($data['viewport']));
        $geometry->setLocationType($data['location_type']);

        if (isset($data['bounds'])) {
            $geometry->setBound($this->buildBound($data['bounds']));
        }

        return $geometry;
    }

    /**
     * @param mixed[] $data
     *
     * @return Bound
     */
    private function buildBound(array $data)
    {
        return new Bound(
            $this->buildCoordinate($data['southwest']),
            $this->buildCoordinate($data['northeast'])
        );
    }

    /**
     * @param mixed[] $data
     *
     * @return Coordinate
     */
    private function buildCoordinate(array $data)
    {
        return new Coordinate($data['lat'], $data['lng']);
    }
}
