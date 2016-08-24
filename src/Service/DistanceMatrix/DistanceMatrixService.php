<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixService extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/distancematrix');
    }

    /**
     * @param DistanceMatrixRequestInterface $request
     *
     * @return DistanceMatrixResponse
     */
    public function process(DistanceMatrixRequestInterface $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->build()));
        $data = $this->parse((string) $response->getBody());

        return $this->buildResponse($data);
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
            'destination_address' => 'destination_addresses',
            'element'             => 'elements',
            'origin_address'      => 'origin_addresses',
            'row'                 => 'rows',
        ]);
    }

    /**
     * @param mixed[] $data
     *
     * @return DistanceMatrixResponse
     */
    private function buildResponse(array $data)
    {
        $response = new DistanceMatrixResponse();
        $response->setStatus($data['status']);
        $response->setDestinations($data['destination_addresses']);
        $response->setOrigins($data['origin_addresses']);
        $response->setRows($this->buildRows($data['rows']));

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return DistanceMatrixRow[]
     */
    private function buildRows($data)
    {
        $rows = [];

        foreach ($data as $row) {
            $rows[] = $this->buildRow($row);
        }

        return $rows;
    }

    /**
     * @param mixed[] $data
     *
     * @return DistanceMatrixRow
     */
    private function buildRow($data)
    {
        $row = new DistanceMatrixRow();
        $row->setElements($this->buildElements($data['elements']));

        return $row;
    }

    /**
     * @param mixed[] $data
     *
     * @return DistanceMatrixElement[]
     */
    private function buildElements(array $data)
    {
        $elements = [];

        foreach ($data as $element) {
            $elements[] = $this->buildElement($element);
        }

        return $elements;
    }

    /**
     * @param mixed[] $data
     *
     * @return DistanceMatrixElement
     */
    private function buildElement(array $data)
    {
        $element = new DistanceMatrixElement();
        $element->setStatus($data['status']);

        if (isset($data['distance'])) {
            $element->setDistance($this->buildDistance($data['distance']));
        }

        if (isset($data['duration'])) {
            $element->setDuration($this->buildDuration($data['duration']));
        }

        if (isset($data['duration_in_traffic'])) {
            $element->setDurationInTraffic($this->buildDuration($data['duration_in_traffic']));
        }

        if (isset($data['fare'])) {
            $element->setFare($this->buildFare($data['fare']));
        }

        return $element;
    }

    /**
     * @param mixed[] $data
     *
     * @return Distance
     */
    private function buildDistance(array $data)
    {
        return new Distance($data['value'], $data['text']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Duration
     */
    private function buildDuration(array $data)
    {
        return new Duration($data['value'], $data['text']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Fare
     */
    private function buildFare(array $data)
    {
        return new Fare($data['value'], $data['currency'], $data['text']);
    }
}
