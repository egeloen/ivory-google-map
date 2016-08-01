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
     * {@inheritdoc}
     */
    public function geocode($request)
    {
        if (!$request instanceof GeocoderRequest) {
            $request = new GeocoderRequest($request);
        }

        if ($this->locale !== null && !$request->hasLanguage()) {
            $request->setLanguage($this->locale);
        }

        $response = $this->getClient()->sendRequest($this->createRequest($request->buildQuery()));
        $data = $this->parse((string) $response->getBody());

        return $this->buildResponse($data);
    }

    /**
     * {@inheritdoc}
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
        $results = [];
        foreach ($data['results'] as $index => $response) {
            $results[] = $this->buildResult($response);

            if ($this->limit !== null && ++$index >= $this->limit) {
                break;
            }
        }

        $response = new GeocoderResponse();
        $response->setStatus($data['status']);
        $response->setResults($results);

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderResult
     */
    private function buildResult(array $data)
    {
        $result = new GeocoderResult();
        $result->setAddressComponents($this->buildAddressComponents($data['address_components']));
        $result->setFormattedAddress($data['formatted_address']);
        $result->setGeometry($this->buildGeometry($data['geometry']));
        $result->setTypes(isset($data['types']) ? $data['types'] : []);
        $result->setPartialMatch(isset($data['partial_match']) ? $data['partial_match'] : null);

        return $result;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderAddressComponent[]
     */
    private function buildAddressComponents(array $data)
    {
        $addressComponents = [];

        foreach ($data as $item) {
            $addressComponents[] = $this->buildAddressComponent($item);
        }

        return $addressComponents;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderAddressComponent
     */
    private function buildAddressComponent(array $data)
    {
        $addressComponent = new GeocoderAddressComponent();
        $addressComponent->setLongName($data['long_name']);
        $addressComponent->setShortName($data['short_name']);
        $addressComponent->setTypes($data['types']);

        return $addressComponent;
    }

    /**
     * @param mixed[] $data
     *
     * @return GeocoderGeometry
     */
    private function buildGeometry(array $data)
    {
        $geometry = new GeocoderGeometry();
        $geometry->setLocation(new Coordinate($data['location']['lat'], $data['location']['lng']));
        $geometry->setLocationType($data['location_type']);
        $geometry->setViewport(new Bound(
            new Coordinate($data['viewport']['southwest']['lat'], $data['viewport']['southwest']['lng']),
            new Coordinate($data['viewport']['northeast']['lat'], $data['viewport']['northeast']['lng'])
        ));

        if (isset($data['bounds'])) {
            $geometry->setBound(new Bound(
                new Coordinate($data['bounds']['southwest']['lat'], $data['bounds']['southwest']['lng']),
                new Coordinate($data['bounds']['northeast']['lat'], $data['bounds']['northeast']['lng'])
            ));
        }

        return $geometry;
    }
}
