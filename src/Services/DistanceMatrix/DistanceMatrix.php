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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\AbstractService;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\GoogleMap\Services\BusinessAccount;
use Ivory\GoogleMap\Services\Utils\XmlParser;
use Ivory\HttpAdapter\HttpAdapterInterface;

/**
 * Distance matrix service.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrix extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        $url = 'http://maps.googleapis.com/maps/api/distancematrix',
        $https = false,
        $format = self::FORMAT_JSON,
        XmlParser $xmlParser = null,
        BusinessAccount $businessAccount = null
    ) {
        parent::__construct($httpAdapter, $url, $https, $format, $xmlParser, $businessAccount);
    }

    /**
     * Processes the request.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request The request.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse The response.
     */
    public function process(DistanceMatrixRequest $request)
    {
        return $this->buildResponse($this->parse(
            (string) $this->getHttpAdapter()->get($this->generateUrl($request))->getBody()
        ));
    }

    /**
     * Generates the url.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $distanceMatrixRequest The request.
     *
     * @return string The generated url.
     */
    protected function generateUrl(DistanceMatrixRequest $distanceMatrixRequest)
    {
        $origins = array();
        foreach ($distanceMatrixRequest->getOrigins() as $origin) {
            $origins[] = $origin instanceof Coordinate
                ? $origin->getLatitude().','.$origin->getLongitude()
                : $origin;
        }

        $destinations = array();
        foreach ($distanceMatrixRequest->getDestinations() as $destination) {
            $destinations[] = $destination instanceof Coordinate
                ? $destination->getLatitude().','.$destination->getLongitude()
                : $destination;
        }

        $httpQuery = array(
            'origins'      => implode('|', $origins),
            'destinations' => implode('|', $destinations),
        );

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

        return $this->signUrl($this->getUrl().'/'.$this->getFormat().'?'.http_build_query($httpQuery));
    }

    /**
     * Parses the body.
     *
     * @param string $body The body.
     *
     * @return array The parsed response.
     */
    protected function parse($body)
    {
        return $this->getFormat() === self::FORMAT_JSON ? $this->parseJson($body) : $this->parseXml($body);
    }

    /**
     * Parses the json body.
     *
     * @param string $response The json body.
     *
     * @return array The parsed json body.
     */
    protected function parseJson($response)
    {
        return json_decode($response, true);
    }

    /**
     * Parses the xml body.
     *
     * @param string $response The xml body.
     *
     * @return array The parsed xml body.
     */
    protected function parseXml($response)
    {
        return $this->getXmlParser()->parse(
            $response,
            array(
                'destination_address' => 'destination_addresses',
                'element'             => 'elements',
                'origin_address'      => 'origin_addresses',
                'row'                 => 'rows',
            )
        );
    }

    /**
     * Builds the response.
     *
     * @param array $response The response.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse The built response.
     */
    protected function buildResponse(array $response)
    {
        return new DistanceMatrixResponse(
            $response['status'],
            $response['origin_addresses'],
            $response['destination_addresses'],
            $this->buildRows($response['rows'])
        );
    }

    /**
     * Builds the rows.
     *
     * @param array $rows The rows.
     *
     * @return array The built rows.
     */
    protected function buildRows($rows)
    {
        $results = array();

        foreach ($rows as $row) {
            $results[] = $this->buildRow($row);
        }

        return $results;
    }

    /**
     * Builds a row.
     *
     * @param array $row The row.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow The built row.
     */
    protected function buildRow(array $row)
    {
        $elements = array();

        foreach ($row['elements'] as $element) {
            $elements[] = $this->buildResponseElement($element);
        }

        return new DistanceMatrixResponseRow($elements);
    }

    /**
     * Builds a response element.
     *
     * @param array $element The response element.
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement The built response element.
     */
    protected function buildResponseElement(array $element)
    {
        $isStatusOk = $element['status'] === DistanceMatrixElementStatus::OK;

        return new DistanceMatrixResponseElement(
            $element['status'],
            $isStatusOk ? new Distance($element['distance']['text'], $element['distance']['value']) : null,
            $isStatusOk ? new Duration($element['duration']['text'], $element['duration']['value']) : null
        );
    }
}
