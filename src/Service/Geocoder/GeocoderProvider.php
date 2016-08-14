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

use Geocoder\Provider\LocaleAwareProvider;
use Geocoder\Provider\LocaleTrait;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\AbstractService;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderProvider extends AbstractService implements LocaleAwareProvider
{
    use LocaleTrait;

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/geocode');
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * {@inheritdoc}
     */
    public function limit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param AbstractGeocoderRequest|Coordinate|string $request
     *
     * @return GeocoderResponse
     */
    public function geocode($request)
    {
        if (!$request instanceof AbstractGeocoderRequest) {
            if ($request instanceof Coordinate) {
                $request = new GeocoderCoordinateRequest($request);
            } else {
                $request = new GeocoderAddressRequest((string) $request);
            }
        }

        if ($this->locale !== null && !$request->hasLanguage()) {
            $request->setLanguage($this->locale);
        }

        $response = $this->getClient()->sendRequest($this->createRequest($request->buildQuery()));
        $data = $this->parse((string) $response->getBody());

        return $this->buildResponse($data);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return GeocoderResponse
     */
    public function reverse($latitude, $longitude)
    {
        return $this->geocode(new Coordinate($latitude, $longitude));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }

    /**
     * @param string $data
     *
     * @return mixed[]
     */
    private function parse($data)
    {
        if ($this->getFormat() === self::FORMAT_JSON) {
            return json_decode($data, true);
        }

        return $this->getXmlParser()->parse($data, [
            'address_component' => 'address_components',
            'type'              => 'types',
            'result'            => 'results',
        ]);
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

        foreach ($data as $index => $response) {
            $results[] = $this->buildResult($response);

            if ($this->limit !== null && ++$index >= $this->limit) {
                break;
            }
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
        $result->setPlaceId($data['place_id']);
        $result->setAddresses($this->buildAddresses($data['address_components']));
        $result->setFormattedAddress($data['formatted_address']);
        $result->setGeometry($this->buildGeometry($data['geometry']));
        $result->setTypes(isset($data['types']) ? $data['types'] : []);
        $result->setPartialMatch(isset($data['partial_match']) ? $data['partial_match'] : null);

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

        foreach ($data as $item) {
            $addresses[] = $this->buildAddress($item);
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
        $geometry->setBound(isset($data['bounds']) ? $this->buildBound($data['bounds']) : null);
        $geometry->setLocation($this->buildCoordinate($data['location']));
        $geometry->setLocationType($data['location_type']);
        $geometry->setViewport($this->buildBound($data['viewport']));

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
