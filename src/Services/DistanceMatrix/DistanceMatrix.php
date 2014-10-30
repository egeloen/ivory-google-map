<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\AbstractService;
use Ivory\GoogleMap\Exception\DistanceMatrixException;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Widop\HttpAdapter\HttpAdapterInterface;

/**
 * DistanceMatrix service.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrix extends AbstractService
{
    /**
     * Creates a distance matrix service.
     *
     * @param \Widop\HttpAdapter\HttpAdapterInterface $httpAdapter The http adapter.
     */
    public function __construct(HttpAdapterInterface $httpAdapter)
    {
        parent::__construct($httpAdapter, 'http://maps.googleapis.com/maps/api/distancematrix');
    }

    /**
     * Processes the given request.
     *
     * Available prototypes:
     * - function process(array $origins, array $destinations)
     * - function process(Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request)
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the request is not valid (prototypes).
     */
    public function process()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof DistanceMatrixRequest)) {
            $distanceMatrixRequest = $args[0];
        } elseif ((isset($args[0]) && is_array($args[0])) && (isset($args[1]) && is_array($args[1]))) {
            $distanceMatrixRequest = new DistanceMatrixRequest();

            $distanceMatrixRequest->setOrigins($args[0]);
            $distanceMatrixRequest->setDestinations($args[1]);
        } else {
            throw DistanceMatrixException::invalidDistanceMatrixRequestParameters();
        }

        if (!$distanceMatrixRequest->isValid()) {
            throw DistanceMatrixException::invalidDistanceMatrixRequest();
        }

        $response = $this->send($this->generateUrl($distanceMatrixRequest));
        $distanceMatrixResponse = $this->buildDistanceMatrixResponse($this->parse($response->getBody()));

        return $distanceMatrixResponse;
    }

    /**
     * Generates distance matrix URL API according to the request.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $distanceMatrixRequest The distance matrix request.
     *
     * @return string The generated URL.
     */
    protected function generateUrl(DistanceMatrixRequest $distanceMatrixRequest)
    {
        $httpQuery = array(
            'origins'      => array(),
            'destinations' => array(),
        );

        foreach ($distanceMatrixRequest->getOrigins() as $origin) {
            if (is_string($origin)) {
                $httpQuery['origins'][] = $origin;
            } else {
                $httpQuery['origins'][] = sprintf(
                    '%s,%s',
                    $origin->getLatitude(),
                    $origin->getLongitude()
                );
            }
        }

        foreach ($distanceMatrixRequest->getDestinations() as $destination) {
            if (is_string($destination)) {
                $httpQuery['destinations'][] = $destination;
            } else {
                $httpQuery['destinations'][] = sprintf(
                    '%s,%s',
                    $destination->getLatitude(),
                    $destination->getLongitude()
                );
            }
        }

        $httpQuery['origins'] = implode('|', $httpQuery['origins']);
        $httpQuery['destinations'] = implode('|', $httpQuery['destinations']);

        if ($distanceMatrixRequest->hasTravelMode()) {
            $httpQuery['mode'] = strtolower($distanceMatrixRequest->getTravelMode());
        }

        if ($distanceMatrixRequest->hasAvoidTolls() && $distanceMatrixRequest->getAvoidTolls()) {
            $httpQuery['avoidTolls'] = true;
        }

        if ($distanceMatrixRequest->hasAvoidHighways() && $distanceMatrixRequest->getAvoidHighways()) {
            $httpQuery['avoidHighways'] = true;
        }

        if ($distanceMatrixRequest->hasUnitSystem()) {
            $httpQuery['units'] = strtolower($distanceMatrixRequest->getUnitSystem());
        }

        if ($distanceMatrixRequest->hasRegion()) {
            $httpQuery['region'] = $distanceMatrixRequest->getRegion();
        }

        if ($distanceMatrixRequest->hasLanguage()) {
            $httpQuery['language'] = $distanceMatrixRequest->getLanguage();
        }

        $httpQuery['sensor'] = $distanceMatrixRequest->hasSensor() ? 'true' : 'false';

        $url = sprintf('%s/%s?%s', $this->getUrl(), $this->getFormat(), http_build_query($httpQuery));

        return $this->signUrl($url);
    }

    /**
     * Parses & normalizes the distance matrix API result response.
     *
     * @param string $response The distance matrix API response.
     *
     * @return \stdClass The parsed & normalized distance matrix response.
     */
    protected function parse($response)
    {
        if ($this->format === 'json') {
            return $this->parseJSON($response);
        }

        return $this->parseXML($response);
    }

    /**
     * Parses & normalizes a JSON distance matrix API result response.
     *
     * @param string $response The distance matrix API JSON response.
     *
     * @return \stdClass The parsed & normalized distance matrix response.
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }

    /**
     * Parses & normalizes an XML distance matrix API result response.
     *
     * @param string $response The distance matrix API XML response.
     *
     * @return \stdClass The parsed & normalized distance matrix response.
     */
    protected function parseXML($response)
    {
        $rules = array(
            'destination_address' => 'destination_addresses',
            'element'             => 'elements',
            'origin_address'      => 'origin_addresses',
            'row'                 => 'rows',
        );

        return $this->xmlParser->parse($response, $rules);
    }

    /**
     * Builds the distance matrix response according to the normalized distance matrix API results.
     *
     * @param \stdClass $distanceMatrixResponse The normalized distance matrix response.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse The built distance matrix response.
     */
    protected function buildDistanceMatrixResponse(\stdClass $distanceMatrixResponse)
    {
        $status = $distanceMatrixResponse->status;
        $destinations = $distanceMatrixResponse->destination_addresses;
        $origins = $distanceMatrixResponse->origin_addresses;
        $rows = $this->buildDistanceMatrixRows($distanceMatrixResponse->rows);

        return new DistanceMatrixResponse($status, $origins, $destinations, $rows);
    }

    /**
     * Builds the distance matrix response rows according to the normalized distance matrix API results.
     *
     * @param array $rows The normalized distance matrix response rows.
     *
     * @return array The built distance matrix response rows.
     */
    protected function buildDistanceMatrixRows($rows)
    {
        $results = array();

        foreach ($rows as $row) {
            $results[] = $this->buildDistanceMatrixRow($row);
        }

        return $results;
    }

    /**
     * Builds a distance matrix response row according to the normalized distance matrix API response row.
     *
     * @param \stdClass $row The normalized distance matrix response row.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow The built distance matrix response row.
     */
    protected function buildDistanceMatrixRow($row)
    {
        $elements = array();

        foreach ($row->elements as $element) {
            $elements[] = $this->buildDistanceMatrixResponseElement($element);
        }

        return new DistanceMatrixResponseRow($elements);
    }

    /**
     * Builds a distance matrix response element according to the normalized distance matrix API response elements.
     *
     * @param \stdClass $element The normalized distance matrix response element.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement The built distance matrix response element.
     */
    protected function buildDistanceMatrixResponseElement($element)
    {
        $status = $element->status;
        $distance = null;
        $duration = null;

        if ($element->status === DistanceMatrixElementStatus::OK) {
            $distance = new Distance($element->distance->text, $element->distance->value);
            $duration = new Duration($element->duration->text, $element->duration->value);
        }

        return new DistanceMatrixResponseElement($status, $distance, $duration);
    }
}
