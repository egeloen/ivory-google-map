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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrix extends AbstractService
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
     * @param DistanceMatrixRequest $request
     *
     * @return DistanceMatrixResponse
     */
    public function process(DistanceMatrixRequest $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->buildQuery()));
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

        foreach ($data as $item) {
            $rows[] = $this->buildRow($item);
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
        $elements = [];
        foreach ($data['elements'] as $element) {
            $elements[] = $this->buildElement($element);
        }

        $row = new DistanceMatrixRow();
        $row->setElements($elements);

        return $row;
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
        $element->setDistance(isset($data['distance']) ? $this->buildDistance($data['distance']) : null);
        $element->setDuration(isset($data['duration']) ? $this->buildDuration($data['duration']) : null);

        return $element;
    }

    /**
     * @param mixed[] $data
     *
     * @return Distance
     */
    private function buildDistance(array $data)
    {
        return new Distance($data['text'], $data['value']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Duration
     */
    private function buildDuration(array $data)
    {
        return new Duration($data['text'], $data['value']);
    }
}
